@extends('layouts.app')
@section('title', 'Modify topics')
@section('content')
    <div class="form-group">
        @include('message')
        <h2>Modify topics</h2>
    </div>

    <div class="row">
        <div class="col-1">ID</div>
        <div class="col-4">Title</div>
        <div class="col-4">Parent</div>
        <div class="col-2">Number of posts</div>
    </div>
    <hr>

    @foreach($topics as $topic)
        <div class="row">
            <div class="col-1">{{ $topic->id }}</div>
            <div class="col-4"><a href="{{ route('admin.topics.show', ['id'=>$topic->id]) }}">{{ $topic->title }}</a></div>
            @if($topic->subforum_id!=0)
                <div class="col-4">{{ \App\Subforum::where('id', $topic->subforum_id)->get()->first()->name }}</div>
            @else
                <div class="col">Main</div>
            @endif
            <div class="col-3">{{ count($topic->posts()->get()) }}</div>
        </div>
    @endforeach
@endsection