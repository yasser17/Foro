<?php

class CreatePostsTest extends FeaturesTestCase
{
    function test_a_user_create_a_post()
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

    function test_a_user_create_a_post_requires_authentication()
    {
        //when
        $this->visit(route('posts.create'))
            ->seePageIs(route('login'));
    }

    function test_created_post_form_validation()
    {
        $this->actingAs($this->defaultUser())
            ->visit(route('posts.create'))
            ->press('Publicar')
            ->seePageIs(route('posts.create'))
            ->seeInElement('#field_title .help-block', 'El campo título es obligatorio')
            ->seeInElement('#field_content .help-block', 'El campo contenido es obligatorio');
    }
}