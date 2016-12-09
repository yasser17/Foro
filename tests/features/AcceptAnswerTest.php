<?php

use App\Comment;

class AcceptAnswerTest extends FeaturesTestCase
{
    function test_the_posts_author_can_accept_a_comment_as_the_post_answer()
    {
        $comment = factory(Comment::class)->create();

        $this->actingAs($comment->post->user);

        $this->visit($comment->post->url)
            ->press('Aceptar respuesta');

        $this->seePageIs($comment->post->url)
            ->seeInElement('.answer', $comment->comment);

        $this->seeInDatabase('posts', [
            'id' => $comment->post->id,
            'pending' => false,
            'answer_id' => $comment->id
        ]);
    }
}
