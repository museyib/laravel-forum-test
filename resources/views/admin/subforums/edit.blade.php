@extends('layouts.app')
@section('title', 'Edit Subforum')
@section('content')
    <div class="container">
        <h2>Edit Subforum</h2>
        <form action="{{ route('subforums.update', ['subforum'=>$subforum]) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text"
                       placeholder="Subforum title" name="name" value="{{$subforum->name}}" id="name">
                <div>{{ $errors->first('name') }}</div>
            </div>

            <div class="form-group">
                <label for="parent_id">Parent subforum</label>
                <select class="form-control" name="parent_id" id="parent_id">
                    <option value="0">Main</option>
                    @foreach($subforums as $newsubforum)
                        @if($newsubforum->id==$subforum->id)
                            @continue
                        @endif
                        <option value="{{ $newsubforum->id }}"
                                {{ $subforum->parent_id==$newsubforum->id ? 'selected' : '' }}>
                            {{ $newsubforum->name }}</option>
                    @endforeach
                </select>
                <div>{{ $errors->first('parent_id') }}</div>
            </div>

            <button class="btn btn-outline-primary">Update subforum</button>
            @csrf
        </form>
    </div>
@endsection