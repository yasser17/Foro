<?php

use App\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends FeaturesTestCase
{
    function test_a_user_can_see_the_post_details()
    {
        // Having
        $user = $this->defaultUser([
            'name' => 'Yasser Mussa'
        ]);

        $post = factory(Post::class)->make([
            'title'   => 'This is the post title',
            'content' => 'this is a post contains'
        ]);

        $user->posts()->save($post);

        //When
        $this->visit(route('posts.show', $post))
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see($user->name);
    }
}
