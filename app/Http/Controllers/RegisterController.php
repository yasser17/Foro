<?php

namespace App\Http\Controllers;

use App\Token;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => [
                'required',
                Rule::unique('users', 'username')
            ],
            'email' => [
                'required',
                Rule::unique('users', 'email')
            ],
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $user = User::create($request->all());

        Token::generateFor($user)->sendByEmail();

        return redirect(route('register_confirmation'));
    }

    public function confirmation()
    {
        return view('register.confirmation');
    }
}
