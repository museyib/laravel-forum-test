@extends('layouts.app')
@section('title', 'Topic: '.$topic->title)
@section('content')
<div class="container">

    @include('forum.forum-nav')

    @include('message')
    <ul class="list-group m-4">
        <h2>{{ $topic->title }}</h2>

        @include('errors')

        @if($topic->posts->first()==null)
        There's no reply
        @else
        @foreach($topic->posts as $post)
        <div class="card my-2 p-2" id="post_{{ $post->id }}">
            <div>
                <a href="{{ route('topics.show', [
                                'parent'=>$parent,
                                'topic'=>$topic]) }}/#post_{{$post->id}}"
                   class="float-right btn btn-outline-primary">Link</a>

                @if(Auth::check() && (Auth::user()->id==$post->user_id || Auth::user()->hasRole('admin')))
                <a href="{{ route('posts.edit', ['subforum'=>$parent, 'post'=>$post]) }}"
                   class="float-right btn btn-outline-primary">Edit</a>
                @endif

                @if(Auth::check())
                <a href="{{ route('posts.reply', ['subforum'=>$parent, 'topic'=>$topic, 'post'=>$post]) }}"
                   class="float-right btn btn-outline-primary">Quote</a>
                @endif

                @if(Auth::check() && Auth::user()->hasRole('admin'))
                <form action="{{ route('admin.posts.delete', ['post'=>$post]) }}" method="post"
                      class="form-inline float-right">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
                @endif
            </div>

            <div class="my-2">
                @if(! is_null($post->reply_to))
                <div class="card-header">
                    <div><strong>Quoted:</strong></div>
                    @if(!is_null(\App\Post::find($post->reply_to)))
                    {{ \App\Post::find($post->reply_to)->content }}
                    <a href="{{ route('topics.show', [
                                            'parent'=>$parent,
                                            'topic'=>$topic])
                                            }}/#post_{{\App\Post::find($post->reply_to)->id}}"
                       class="float-right">Go to the post</a>
                    <div class="my-2">
                        <strong>Author:</strong>
                        {{ \App\Post::find($post->reply_to)->user->name }}
                    </div>
                    @else
                    <span class="alert-warning">This post is deleted</span>
                    @endif
                </div>
                @endif
            </div>

            <div>
                {{ $post->content }}
            </div>

            <p class="card-subtitle text-muted pt-5">
                Posted by <strong>{{ $post->user->name }}</strong> at {{ $post->created_at }}</p>
            @if($post->updated_at!=$post->created_at)
            <p class="card-subtitle text-muted">
                Edited at {{ $post->updated_at }}</p>
            @endif
        </div>
        @endforeach
        @endif
    </ul>
</div>
@auth
<form action="{{ route('posts.store') }}" method="post">
    <label for="content">Reply:</label>
    <textarea name="content" id="content" cols="30" rows="10" class="form-control"
              required="required"></textarea>
    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <button type="submit" class="btn btn-outline-primary">Reply</button>
    @csrf
</form>
@endauth
@endsection
