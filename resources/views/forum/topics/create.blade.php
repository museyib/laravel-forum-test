@extends('layouts.app')
@section('title', 'Create new topic')
@section('content')
   <div class="container">
       @include('forum.forum-nav')
       <h2>Create new topic</h2>
       <form action="{{ route('topics.store') }}" method="post">
           <label for="title">Title</label>
           <input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('title') }}" required>
           @if($errors->first('title'))
               <p class="alert alert-danger">{{ $errors->first('title') }}</p>
           @endif

           <label for="content">Content:</label>
           <textarea name="content" id="content" cols="30" rows="10" class="form-control" required>
               {{ old('content') }}</textarea>
           @if($errors->first('title'))
               <p class="alert alert-danger">{{ $errors->first('content') }}</p>
           @endif
           <input type="hidden" name="subforum_id" value="{{ $parent->id }}">
           <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
           <button type="submit" class="btn btn-outline-primary">Create</button>
           @csrf
       </form>
   </div>
@endsection