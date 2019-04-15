@extends('layouts.app')
@section('title', 'Edit topic')
@section('content')
    <div class="container">
        <h2>Edit topic</h2>
        <div>{{ $errors->first() }}</div>
        <form action="{{ route('admin.topics.update', ['topic'=>$topic]) }}" method="post">
            <div class="form-group">
                <label for="title">Name</label>
                <input class="form-control" type="text"
                       placeholder="Topic title" name="title" value="{{$topic->title}}" id="title">
                <div>{{ $errors->first('name') }}</div>
            </div>

            <div class="form-group">
                <label for="subforum_id">Parent subforum</label>
                <select class="form-control" name="subforum_id" id="subforum_id">
                    @foreach($subforums as $subforum)
                        <option value="{{ $subforum->id }}"
                                {{ $topic->subforum_id==$subforum->id ? 'selected' : '' }}>
                            {{ $subforum->name }}</option>
                    @endforeach
                </select>
                <div>{{ $errors->first('parent_id') }}</div>
            </div>

            <button class="btn btn-outline-primary">Update topic</button>
            @csrf
        </form>
    </div>
@endsection