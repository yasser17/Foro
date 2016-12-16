<?php

use App\User;

class SubscribeToPostsTest extends FeaturesTestCase
{
    function test_a_user_can_subscribe_to_a_post()
    {
        //having
        $post = $this->createPost();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        //when
        $this->visit($post->url)
            ->press('Suscribirse al post');

        //then
        $this->seeInDatabase('subscriptions', [
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $this->seePageIs($post->url)
            ->dontSee('Suscribirse al post');
    }
}
