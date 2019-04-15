@extends('layouts.app')
@section('title', 'Create new Subforum')
@section('content')
    <div class="container">
        <h2>Create new Subforum</h2>
        <form action="{{ route('subforums.store') }}" method="post">
           <div class="form-group">
               <label for="name">Name</label>
               <input class="form-control" type="text" placeholder="Subforum title" name="name" id="name">
               <div>{{ $errors->first('name') }}</div>
           </div>

            <div class="form-group">
                <label for="parent_id">Parent subforum</label>
                <select class="form-control" name="parent_id" id="parent_id">
                    <option value="0">Main</option>
                    @foreach($subforums as $subforum)
                        <option value="{{ $subforum->id }}">{{ $subforum->name }}</option>
                    @endforeach
                </select>
                <div>{{ $errors->first('parent_id') }}</div>
            </div>

            <button class="btn btn-outline-primary">Add subforum</button>
            @csrf
        </form>
    </div>
@endsection