<?php

class CreatePostsTest extends FeaturesTestCase
{
    public function test_a_user_create_a_post()
    {
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        $this->actingAs($user = $this->defaultUser())
        ->visit(route('posts.create'))
        ->type($title, 'title')
        ->type($content, 'content')
        ->press('Publicar');

        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' => $user->id,
        ]);

        $this->see($title);
    }

    public function test_a_user_create_a_post_requires_authentication()
    {
        //when
        $this->visit(route('posts.create'));

        //them
        $this->seePageIs(route('login'));
    }
}