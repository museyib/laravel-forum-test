@extends('layouts.app')

@section('title', 'User details')

@section('content')
    <h1>User details</h1>
    @include('message')
    <a href="{{ route('users.edit', ['user'=>$user]) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('users.delete', ['user'=>$user]) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <div>
        <p><strong>Name: </strong>{{ $user->name }}</p>
        <p><strong>Display name: </strong>{{ $user->email }}</p>
    </div>
@endsection