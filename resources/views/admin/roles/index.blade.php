@extends('layouts.app')

@section('title', 'Roles list')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Role list </h2>
                @include('message')
                <a href="roles/create">Create new role</a>
            </div>
            @if ($roles->isEmpty())
                <p> There is no role.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td><a href="{{ route('roles.show', ['role'=>$role]) }}">{!! $role->name !!}</a></td>
                            <td>{!! $role->display_name !!}</td>
                            <td>{!! $role->description !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection