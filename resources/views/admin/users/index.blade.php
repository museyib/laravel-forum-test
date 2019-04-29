@extends('layouts.app')

@section('title', 'User list')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> User list </h2>
                @include('message')
                <a href="users/create">Create new user</a>
            </div>
            @if ($users->isEmpty())
                <p> There is no role.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><a href="{{ route('users.show', ['user'=>$user]) }}">{!! $user->name !!}</a></td>
                            <td>{!! $user->email !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection