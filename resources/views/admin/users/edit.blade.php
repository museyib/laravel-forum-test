@extends('layouts.app')

@section('title', 'Add new role')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">
            <form class="form-horizontal" method="post">
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif{!! csrf_field() !!}
                    <fieldset>
                        <legend>Edit user</legend>
                        @include('message')
                        <div class="form-group">
                            <label for="name" class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                           value="{{ $user->name }}">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                           value="{{ $user->email }}">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-lg-2 control-label">Role</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="role" name="role[]" multiple>
                                        @foreach($roles as $role)
                                            <option value="{!! $role->id !!}"
                                                    @if(in_array($role->id, $selected_roles))
                                                        selected="selected"
                                                    @endif>
                                                {!! $role->display_name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <label>
                                    <input type="password" class="form-control" name="password">
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-lg-2 control-label">Confirm password</label>
                            <div class="col-lg-10">
                                <label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </fieldset>
            </form>
        </div>
    </div>
@endsection
