<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\{Post, User, Comment};

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'pending' => true,
        'user_id' => function () { //con esta function solamente se va crear el usuario cuando no se pase un usuario
            return factory(User::class)->create()->id;
        }
    ];
});

$factory->define(Comment::class, function(\Faker\Generator $faker) {
   return [
        'comment' => $faker->paragraph,
        'post_id' => function () {
            return factory(Post::class)->create()->id;
        },
       'user_id' => function () {
           return factory(User::class)->create()->id;
       }
   ];
});

