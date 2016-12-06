<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post, $slug)
    {
        //abort_if($post->slug != $slug, 404);

        return view('posts.show', compact('post'));
    }
}
