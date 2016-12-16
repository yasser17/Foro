<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'content'];

    protected $casts = [
        'pending' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function lastestComments()
    {
        return $this->comments()->orderBy('created_at', 'desc');
    }

    public function subscriptions()
    {
        return $this->belongsToMany(User::class, 'subscriptions');
    }

    public function getUrlAttribute()
    {
        return route('posts.show', [$this->id, $this->slug]);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $this->attributes['slug'] = Str::slug($value);
    }

    public function getSafeHtmlContentAttribute()
    {
        return Markdown::convertToHtml(e($this->content));
    }
}
