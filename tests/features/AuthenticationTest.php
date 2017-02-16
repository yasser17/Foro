<?php

use App\Token;
use Illuminate\Support\Facades\Mail;

class AuthenticationTest extends FeaturesTestCase
{
    function test_a_guest_user_can_request_a_token()
    {
        Mail::fake();

        $user = $this->defaultUser(['email' => 'admin@foro.com']);

        $this->visitRoute('login')
            ->type('admin@foro.com', 'email')
            ->press('Solicitar Token');

        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token);

        Mail::assertSentTo($user, \App\Mail\TokenMail::class, function ($mail) use ($token) {
            return $mail->token->id === $token->id;
        });

        $this->dontSeeIsAuthenticated();
    }
}
