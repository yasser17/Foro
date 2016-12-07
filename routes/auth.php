<?php

Route::get('/posts/create', [
    'uses' =>  'CreatePostController@create',
    'as' => 'posts.create'
]);

Route::post('/posts/create', [
    'uses' =>  'CreatePostController@store',
    'as' => 'posts.store'
]);

Route::post('/comments/create', [
    'uses' => 'CommentController@store',
    'as' => 'comments.store'
]);