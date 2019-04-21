@extends('layouts.app')
@section('title', 'Subforum: '.$parent->name)
@section('content')
    <div class="container">
        <a href="/forum">Main</a>
        @foreach(\App\Subforum::getParents($parent->id) as $parentsub)
            @if($parentsub->level<$parent->level)
                / <a href="/forum/{{ $parentsub->id }}">{{ $parentsub->name }}</a>
            @else
                / {{ $parentsub->name }}
            @endif
        @endforeach
        @include('message')
        <ul class="list-group m-4">
           @foreach($subforums as $subforum)
               @if($subforum->level==$level+1)
                   <li class="list-group-item">
                       <a href="{{ $subforum->id }}">{{ $subforum->name }}</a>
                       <span class="float-right">Topics: {{ count($subforum->topics()->get()) }},
                            Subforums: {{ count($subforum->getChilds()) }}</span>
                   </li>
               @endif
           @endforeach
       </ul>
    </div>
    @auth
        <a href="{{ route('topics.create', ['subforum_id'=>$parent->id]) }}"
           class="btn btn-outline-primary">Create new topic</a>
    @endauth
    <div class="container my-2">
        @foreach($parent->topics as $topic)
            <div class="card-header py-2 my-2">
                <a href="{{ route('topics.show', ['topic'=>$topic, 'parent'=>$parent]) }}">{{ $topic->title }}</a>
                <p class="card-subtitle text-muted pt-2">
                    Created by <strong>{{ $topic->user()->name }}</strong> at: {{ $topic->created_at }}</p>
                <p class="card-subtitle text-muted">
                    Last <a href="{{ route('topics.show', ['parent'=>$parent->id,'topic'=>$topic->id]) }}#post_{{ $topic->lastPost()->id }}">
                        post</a> by <strong>{{ $topic->lastUser()->name }}</strong> at {{ $topic->updated_at }}</p>
            </div>
        @endforeach
    </div>
@endsection