@extends('layouts.app')
@section('title', 'Forum')
@section('content')
    <div class="container">
        Forum

        @include('forum.subforums')
    </div>
@endsection