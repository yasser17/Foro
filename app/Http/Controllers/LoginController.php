<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login($token)
    {
        $token = Token::where('token', $token)->first();

        if ($token == null) {
            alert('Este enlace ya expiró, por favor solicite otro', 'danger');

            return redirect()->route('token');
        }

        Auth::login($token->user);

        $token->delete();

        return redirect('/');
    }
}
