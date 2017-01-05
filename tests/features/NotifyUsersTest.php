<?php

use Illuminate\Support\Facades\Notification;

class NotifyUsersTest extends FeaturesTestCase
{
    /*function test_the_subscribers_receive_a_notification_when_post_is_commented()
    {
        Notification::fake();

        $post = $this->createPost();

        $subscriber = factory(\App\User::class)->create();

        $subscriber->subscribeTo($post);

        $writer = factory(\App\User::class)->create();

        $writer->comment($post, 'Un comentario cualquiera');

        Notification::assertSentTo($subscriber, PostCommented::class, function ($notification) use ($post) {
            return $notification->post->id == $post->id;
        });
    }*/
}
