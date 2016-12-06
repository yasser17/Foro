<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    function test_a_slug_is_generated_and_saved_in_database()
    {
        $post = $this->createPost([
            'title' => 'Como instalar Laravel'
        ]);

        $this->assertSame(
            'como-instalar-laravel',
            $post->fresh()->slug
        );
    }
}
