@extends('layouts.app')

@section('title', 'Edit role')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Edit role</h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{ route('roles.update', ['role'=>$role]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name" class="col-lg-2 control-label">Name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ $role->name }}">
                </div>
            </div>
            <div class="form-group">
                <label for="display_name" class="col-lg-2 control-label">Display Name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="display_name" name="display_name"
                           value="{{ $role->display_name }}">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-lg-2 control-label">Description</label>
                <div class="col-lg-10">
                        <textarea class="form-control" rows="3" id="description" name="description">
                            {{ $role->description }}
                        </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
