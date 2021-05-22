@extends('layouts.app')

@section('title', 'Roles list')

@section('content')
<div class="form-group">
    @include('message')
    <h2> Role list </h2>
    <a href="{{ url('admin/roles/create') }}">Create new role</a>
</div>

@if ($roles->isEmpty())
<p> There is no role.</p>
@else
<table class="table">
    <tr>
        <th>Name</th>
        <th>Display Name</th>
        <th>Description</th>
    </tr>
    @foreach($roles as $role)
    <tr>
        <td><a href="{{ route('roles.show', ['role'=>$role]) }}">{!! $role->name !!}</a></td>
        <td>{!! $role->display_name !!}</td>
        <td>{!! $role->description !!}</td>
    </tr>
    @endforeach
</table>
@endif
@endsection
