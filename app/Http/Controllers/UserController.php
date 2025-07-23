<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function create()
    {
        return view("user.create");
    }

    public function edit()
    {
        return view("user.edit");
    }

    public function update(Request $request)
    {

        $user = User::where('id', '=', $request->id)->first();
        // обновлять можно только свои посты
        if (!$user->isOwner($request->id)) {
            abort(404);
        }


        $request->validate([
            'name' => ['required', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
        ]);


        if ($request->hasFile('avatar')) {
            $avaName = $request->avatar->store('/', 'avatars');
            $manager = new ImageManager(new Driver());
            $ava_compressed = $manager->read('storage/images/avatars/' . $avaName);
            $ava_compressed->cover(300, 300);
            $ava_compressed->save('storage/images/avatars/comp/' . $avaName);

            Storage::disk('avatars')->delete($user->avatar);
            Storage::disk('avatars')->delete('comp/'.$user->avatar);

            $user->update([
                'name' => $request['name'],
                'avatar' => $avaName,
            ]);



        } else {
            $user->update([
                'name' => $request['name'],
            ]);
        }

        return redirect()->route('profile')->with('success', 'Профиль успешно обновлён!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
        ]);


        if ($request->hasFile('avatar')) {
            $avaName = $request->avatar->store('/', 'avatars');
            $manager = new ImageManager(new Driver());
            $ava_compressed = $manager->read('storage/images/avatars/' . $avaName);
            $ava_compressed->cover(300, 300);
            $ava_compressed->save('storage/images/avatars/comp/' . $avaName);
        } else {
            $avaName = 'default_avatar.jpg';
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
            'avatar' => $avaName,
        ]);


        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function login()
    {
        return view("user.login");
    }

    public function loginAuth(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required',],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('userlist')->with('success', 'Добро пожаловайт, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Неверный ящик или пароЛ',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        // $request->cookie()->flush();
        return redirect()->route("login");
    }


    public function forgotPasswordStore(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


}
