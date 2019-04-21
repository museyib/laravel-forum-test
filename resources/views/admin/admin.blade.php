@extends('layouts.app')
@section('title', 'Manage forum')
@section('content')
    <h2>Manage forum</h2>
    <div class="row">
        <div class="col-12">
            <div><a href="admin/subforums">Subforums</a></div>
            <div><a href="admin/topics">Topics</a></div>
            <div><a href="admin/users">Users</a></div>
            <div><a href="admin/roles">Roles</a></div>
        </div>
    </div>
@endsection