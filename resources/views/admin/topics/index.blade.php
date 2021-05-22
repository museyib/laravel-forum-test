@extends('layouts.app')

@section('title', 'Modify topics')

@section('content')
<div class="form-group">
    @include('message')
    <h2>Modify topics</h2>
</div>

<table class="table">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Parent subforum</th>
        <th>Number of posts</th>
    </tr>

    @foreach($topics as $topic)
    <tr>
        <td>{{ $topic->id }}</td>
        <td><a href="{{ route('admin.topics.show', ['id'=>$topic->id]) }}">{{ $topic->title }}</a></td>
        <td>{{ $topic->created_at }}</td>
        <td>{{ $topic->updated_at }}</td>

        @if($topic->subforum_id!=0)
        <td>{{ $topic->subforum->name }}</td>
        @else
        <td>Main</td>
        @endif

        <td>{{ count($topic->posts()->get()) }}</td>
    </tr>
    @endforeach
</table>
@endsection
