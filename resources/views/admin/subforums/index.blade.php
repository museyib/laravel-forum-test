@extends('layouts.app')
@section('title', 'Modify Subforums')
@section('content')
    <div class="form-group">
        @include('message')
            <h2>Modify Subforums</h2>
            <a href="{{ url('admin/subforums/create') }}">Create new Subforum</a>
    </div>

    <div class="row">
        <div class="col-1">ID</div>
        <div class="col-4">Title</div>
        <div class="col-4">Parent</div>
        <div class="col-2">Number of topics</div>
    </div>
    <hr>

    @foreach($subforums as $subforum)
        <div class="row">
            <div class="col-1">{{ $subforum->id }}</div>
            <div class="col-4"><a href="/admin/subforums/{{ $subforum->id }}">{{ $subforum->name }}</a></div>
            @if($subforum->parent_id!=0)
                <div class="col-4">{{ \App\Subforum::getById($subforum->parent_id)->name }}</div>
            @else
                <div class="col-4">Main</div>
            @endif
            <div class="col-1">{{ count($subforum->topics()->get()) }}</div>
        </div>
    @endforeach
@endsection