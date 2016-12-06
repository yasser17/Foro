<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    public $defaultUser;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }


    /**
     * @return \App\User
     */
    public function defaultUser()
    {
        if ($this->defaultUser) {
            return $this->defaultUser;
        }

        return $this->defaultUser = factory(\App\User::class)->create();
    }

    public function createPost(array $attributes = [])
    {
        return factory(\App\Post::class)->create($attributes);
    }
}
