<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'user_id', 'post_id'];

    protected $casts = [
        'answer' => 'boolean'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsAnswer()
    {
        $this->answer = true;

        $this->save();

        $this->post->pending = false;

        $this->post->save();
    }
}