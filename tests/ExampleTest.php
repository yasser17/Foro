<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $user = factory(\App\User::class)->create([
            'name'      => 'Yasser Mussa',
            'email'     => 'yasser.mussa@gmail.com'
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see('Yasser Mussa')
            ->see('yasser.mussa@gmail.com');
    }

    public function test_index()
    {
        $this->visit('/')
            ->see('Laravel');
    }
}
