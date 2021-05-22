@extends('layouts.app')

@section('title', 'User list')

@section('content')
<div class="form-group">
    @include('message')
    <h2> User list </h2>
    <a href="{{ url('admin/users/create') }}">Create new user</a>
</div>

@if ($users->isEmpty())
<p> There is no role.</p>
@else
<table class="table">
    <tr>
        <th>Name</th>
        <th>E-mail</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td><a href="{{ route('users.show', ['user'=>$user]) }}">{!! $user->name !!}</a></td>
        <td>{!! $user->email !!}</td>
    </tr>
    @endforeach
</table>
@endif
@endsection
