@extends('layouts.app')
@section('title', 'Subforum: '.$parent->name)
@section('content')
    <div class="container">
        <a href="/forum">Main</a>

        @include('forum.forum-nav')

        @include('message')

        @include('forum.subforums')
    </div>
    @auth
        <a href="{{ route('topics.create', ['subforum_id'=>$parent->id]) }}"
           class="btn btn-outline-primary my-2">Create new topic</a>
    @endauth
    @if(count($parent->topics)>0)
        <div class="container my-2">
            @foreach($parent->topics as $topic)
                <div class="card-header py-2 my-2">
                    <a href="{{ route('topics.show', ['topic'=>$topic, 'parent'=>$parent]) }}">{{ $topic->title }}</a>
                    <p class="card-subtitle text-muted pt-2">
                        Created by <strong>{{ $topic->user->name }}</strong> at: {{ $topic->created_at }}</p>
                    <p class="card-subtitle text-muted">
                        Last <a href="{{ route('topics.show', ['parent'=>$parent->id,'topic'=>$topic->id]) }}#post_{{ $topic->lastPost()->id }}">
                            post</a> by <strong>{{ $topic->lastUser()->name }}</strong> at {{ $topic->updated_at }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection