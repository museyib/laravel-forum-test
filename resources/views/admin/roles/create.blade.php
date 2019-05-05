@extends('layouts.app')

@section('title', 'Add new role')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Add a new role</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('roles.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                </div>
                <div class="form-group">
                    <label for="display_name" class="col-lg-2 control-label">Display Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="display_name" name="display_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" id="description" name="description" required></textarea>
                    </div>
                </div>

                @include('errors')

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection