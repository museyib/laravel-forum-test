@extends('layouts.app')
@section('title', 'Topic: '.$topic->title)
@section('content')
    <div class="container">
        <a href="/forum">Main</a>
        @foreach(\App\Subforum::getParents($parent->id) as $parentsub)
            / <a href="/forum/{{ $parentsub->id }}">{{ $parentsub->name }}</a>
        @endforeach
        @include('message')
        <ul class="list-group m-4">
            <h2>{{ $topic->title }}</h2>
            @if($topic->posts->first()==null)
                There's no reply
            @else
                @foreach($topic->posts as $post)
                   <div class="card my-2 p-2" id="post_{{ $post->id }}">

                       <div>
                           {{ $post->content }}
                           <a href="{{ route('topics.show', ['id'=>$topic->id]) }}/#post_{{$post->id}}"
                              class="float-right">Link</a>

                           @if(Auth::check() && (Auth::user()->id==$post->user_id || Auth::user()->hasRole('admin')))
                               <a href="{{ action('PostController@edit', ['post'=>$post]) }}"
                                  class="float-right">Edit&nbsp;</a>
                           @endif
                           @if(Auth::check() && Auth::user()->hasRole('admin'))
                               <form action="{{ route('admin.posts.delete', ['post'=>$post]) }}" method="post">
                                   @csrf
                                   <button type="submit" class="btn-link float-right">Delete&nbsp;</button>
                               </form>
                           @endif
                       </div>

                       <p class="card-subtitle text-muted pt-5">
                           Posted by <strong>{{ $post->user()->name }}</strong> at {{ $post->created_at }}</p>
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