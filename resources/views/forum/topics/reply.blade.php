@extends('layouts.app')
@section('title', 'Reply')
@section('content')
    <h3>Quote this post:</h3>
    @auth
        <div class="card my-2 p-2">
            <div>
                "{{ \App\Post::getById($post)->content }}"
            </div>
        </div>
        <form action="{{ route('posts.store') }}" method="post">
            <label for="content">Reply:</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"
                      required="required"></textarea>
            <input type="hidden" name="reply_to" value="{{ $post }}">
            <input type="hidden" name="topic_id" value="{{ $topic }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-outline-primary">Reply</button>
            @csrf
        </form>
    @endauth
@endsection