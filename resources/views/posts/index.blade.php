@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>
    <ul>
        @foreach($posts as $post)
        <li><a href="{{ $post->url }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>

    {{ $posts->render() }}
</div>
@endsection