<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    //

    public function userlist()
    {
        $users = User::all("id","name","email_verified_at","avatar" );

        // dd($users);
        return view('content.userlist', compact('users'));

    }
    public function profile()
    {
        return view('content.profile');
    }
}
