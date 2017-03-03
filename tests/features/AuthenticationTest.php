<?php

use App\Token;

class AuthenticationTest extends FeatureTestCase
{
    public function test_a_user_can_login_with_a_token_url()
    {
        $user = $this->defaultUser();

        $token = Token::generateFor($user);

        $this->visit("login/{$token->token}")
            ->seeIsAuthenticated()
            ->seeIsAuthenticatedAs($user);

        $this->dontSeeInDatabase('tokens', [
            'id' => $token->id
        ]);

        $this->seePageIs('/');
    }

    function test_a_user_cannot_login_with_an_invalid_token()
    {
        //have
        $user = $this->defaultUser();
        $token = Token::generateFor($user);
        $invalid_token = str_random(60);
        //when
        $this->visit("login/{$invalid_token}");

        $this->dontSeeIsAuthenticated()
            ->seeRouteIs('token')
            ->see('Este enlace ya expiró, por favor solicite otro');

        $this->seeInDatabase('tokens', [
            'id' => $token->id
        ]);
    }
}
