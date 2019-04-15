@extends('layouts.app')
@section('title', 'Manage forum')
@section('content')
    <h2>Manage forum</h2>
    <div class="row">
        <div class="col-12">
            <div><a href="admin/subforums">Subforums</a></div>
            <div><a href="{{ route('admin.topics.index') }}">Topics</a></div>
        </div>
    </div>
@endsection