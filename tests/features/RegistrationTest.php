<?php

use App\Token;
use App\User;
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends FeaturesTestCase
{
    /**
     *
     */
    function test_a_user_can_create_an_account()
    {
        Mail::fake();

        $this->visitRoute('register')
            ->type('yasser.mussa@gmail.com', 'email')
            ->type('yasser', 'username')
            ->type('Yasser', 'first_name')
            ->type('Mussa', 'last_name')
            ->press('Regístrate');

        $this->seeInDatabase('users', [
            'email' => 'yasser.mussa@gmail.com',
            'username' => 'yasser',
            'first_name' => 'Yasser',
            'last_name' => 'Mussa'
        ]);

        $user = User::first();

        $this->seeInDatabase('tokens', [
            'user_id' => $user->id
        ]);

        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token);

        Mail::assertSentTo($user, TokenMail::class, function ($mail) use ($token) {
            return $mail->token->id == $token->id;
        });

        $this->seeRouteIs('register_confirmation')
            ->see('Gracias por registrarte')
            ->see('Enviamos a tu email un enlace para que inicies sesión');
    }

    function test_a_user_can_see_errors()
    {
        $this->visitRoute('register')
            ->press('Regístrate')
            ->seeErrors([
                'email' => 'El campo email es obligatorio',
                'username' => 'El campo username es obligatorio',
                'first_name' => 'El campo nombre es obligatorio',
                'last_name' => 'El campo apellido es obligatorio'
            ]);
    }
}
