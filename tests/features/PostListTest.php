<?php

use App\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostListTest extends FeaturesTestCase
{
    function test_a_user_can_see_the_posts_list_and_go_to_the_details()
    {
        $post = $this->createPost([
            'title' => 'Debo utilizar Laravel 5.3 o 5.1 LTS'
        ]);

        $this->visit('/')
            ->seeInElement('h1', 'Posts')
            ->see($post->title)
            ->click($post->title)
            ->seePageIs($post->url);
    }

    function test_posts_are_paginated()
    {
        $first = factory(Post::class)->create([
            'title' => 'Primer post'
        ]);

        factory(Post::class)->times(15)->create();

        $last = factory(Post::class)->create([
            'title' => 'El ultimo post'
        ]);

        $this->visit('/')
            ->see($first->title)
            ->dontSee($last->title)
            ->click('2')
            ->see($last->title)
            ->dontSee($first->title);
    }
}
