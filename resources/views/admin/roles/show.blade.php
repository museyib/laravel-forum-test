@extends('layouts.app')

@section('title', 'Role details')

@section('content')
    <h1>Role details</h1>
    @include('message')
    <a href="{{ route('roles.edit', ['id'=>$id]) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('roles.delete', ['id'=>$id]) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <div>
        <p><strong>Name: </strong>{{ \App\Role::where('id', $id)->first()->name }}</p>
        <p><strong>Display name: </strong>{{ \App\Role::where('id', $id)->first()->display_name }}</p>
        <p><strong>Description: </strong>{{ \App\Role::where('id', $id)->first()->description }}</p>
    </div>
@endsection