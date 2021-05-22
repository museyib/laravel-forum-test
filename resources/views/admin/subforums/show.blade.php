@extends('layouts.app')
@section('title', 'Subforum details')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>Details for {{ $subforum->name }}</h1>
        <a href="/admin/subforums/{{ $subforum->id }}/edit" class="btn btn-primary">Edit</a>

        <form action="/admin/subforums/{{ $subforum->id }}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <p><strong>Name: </strong>{{ $subforum->name }}</p>
        <p><strong>Parent subforum: </strong>
            @if($subforum->parent_id!=0)
            {{ $subforum->parent()->name }}
            @else
            Main
            @endif
        </p>
    </div>
</div>
@endsection
