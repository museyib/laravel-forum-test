@extends('layouts.app')
@section('title', 'Edit post')
@section('content')
<div class="container">
    <h2>Edit post</h2>
    @include('message')
    <form action="{{ route('posts.update', ['post'=>$post]) }}" method="post">

        <label for="content">Content:</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control" required>
               {{ $post->content }}</textarea>

        @include('errors')
        <button type="submit" class="btn btn-outline-primary">Update</button>
        @csrf
    </form>
</div>
@endsection
