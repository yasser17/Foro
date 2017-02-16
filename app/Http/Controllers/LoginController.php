<?php

namespace App\Http\Controllers;

use App\Token;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view('login.create');
    }

    public function store(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        Token::generateFor($user)->sendByEmail();
    }
}
