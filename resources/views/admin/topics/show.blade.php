@extends('layouts.app')
@section('title', 'Topic details')
@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Details for {{ $topic->title }}</h1>
            <p><a href="{{ route('admin.topics.edit', ['topic'=>$topic]) }}">Edit</a></p>

            <form action="{{ route('admin.topics.delete', ['topic'=>$topic])}}" method="post">
                @csrf
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p><strong>Name: </strong>{{ $topic->title }}</p>
            <p><strong>Parent subforum: </strong>
                @if($topic->subforum_id!=0)
                    {{ $parent->name }}
                @else
                    Main
                @endif
            </p>
        </div>
    </div>
@endsection