<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WriteCommentTest extends FeaturesTestCase
{
    function test_a_user_can_write_a_comment()
    {
        $user = $this->defaultUser();
        $commentary = 'Un comentario';
        $post = $this->createPost();

        $this->actingAs($user)
            ->visit($post->url)
            ->type($commentary, 'comment')
            ->press('Publicar comentario');

        $this->seeInDatabase('comments', [
            'comment' => $commentary,
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $this->seePageIs($post->url);
    }

    function test_created_comment_form_validation()
    {
        $user = $this->defaultUser();
        $post = $this->createPost();

        $this->actingAs($user)
            ->visit($post->url)
            ->press('Publicar comentario');

        $this->dontSeeInDatabase('comments', [
            'comment' => '',
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $this->seePageIs($post->url)
            ->seeErrors([
                'comment' => 'El campo comentario es obligatorio'
            ]);
    }
}
