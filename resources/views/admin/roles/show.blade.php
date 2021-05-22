@extends('layouts.app')

@section('title', 'Role details')

@section('content')
<h1>Role details</h1>
@include('message')
<a href="{{ route('roles.edit', ['role'=>$role]) }}" class="btn btn-primary">Edit</a>
<form action="{{ route('roles.delete', ['role'=>$role]) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
<div>
    <p><strong>Name: </strong>{{ $role->name }}</p>
    <p><strong>Display name: </strong>{{ $role->display_name }}</p>
    <p><strong>Description: </strong>{{ $role->description }}</p>
</div>
@endsection
