<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class UserController extends Controller
{


    public function create()
    {
        return view("user.create");
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
        } else {
            $avaName = 'default_avatar.jpg';
        }

        // $user = User::create($request->all());

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
