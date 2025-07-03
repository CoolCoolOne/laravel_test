<?php

use App\Http\Controllers\ContentController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get("/", [
    function () {
        return view("welcome");
    }
])->name("home");

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get("userlist", [ContentController::class, 'userlist'])->name('userlist');

    Route::get('/posts', [PostController::class, 'index'])->name('all_posts'); // Cписoк всех постов
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // Форма создания 
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Сохранение нового 
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit'); // Форма редактирования
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update'); // Обновление
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // Удаление 

});




Route::middleware('guest')->group(function () {

    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'loginAuth'])->name('login.auth');

    Route::get('forgot-password', [
        function () {
            return view("user.forgot-password");
        }
    ])->name("password.request");

    Route::post('forgot-password', [UserController::class, 'forgotPasswordStore'])->middleware(['throttle:2,1'])->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('user.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('reset-password', [UserController::class, 'resetPasswordUpdate'])->middleware(['throttle:2,1'])->name('password.update');
});




Route::middleware('auth')->group(function () {
    Route::get('verify-email', function () {
        return view('user.verify-email');
    })->name('verification.notice');


    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('dashboard');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Ссылка для подтверждения отправлена на почту!');
    })->middleware(['throttle:2,1'])->name('verification.send');

    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});

