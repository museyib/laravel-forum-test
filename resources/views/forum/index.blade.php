@extends('layouts.app')
@section('title', 'Forum')
@section('content')
    <div class="container">
        Forum
        <ul class="list-group m-4">
            @foreach($subforums as $subforum)
                @if($subforum->level==$level+1)
                    <li class="list-group-item">
                        <a href="{{ route('forum.show', ['id'=>$subforum->id]) }}">{{ $subforum->name }}</a>
                        <span class="float-right">Topics: {{ count($subforum->topics()->get()) }},
                            Subforums: {{ count($subforum->getChilds()) }}</span>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endsection