@extends('layouts.app')

@section('title', 'Modify Subforums')

@section('content')
    <div class="form-group">
        @include('message')
        <h2>Modify Subforums</h2>
        <a href="{{ url('admin/subforums/create') }}">Create new subforum</a>
    </div>

    <table class="table">
        <tr>
            <th>Title</th>
            <th>Parent</th>
            <th>Number of topics</th>
        </tr>

    @foreach($subforums as $subforum)
        <tr>
            <td><a href="/admin/subforums/{{ $subforum->id }}">{{ $subforum->name }}</a></td>
            @if($subforum->parent_id!=0)
                <td>{{ $subforum->parent()->name }}</td>
            @else
                <td>Main</td>
            @endif
            <td>{{ count($subforum->topics) }}</td>
        </tr>
    @endforeach
    </table>
@endsection