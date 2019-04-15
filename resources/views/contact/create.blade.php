@extends('layouts.app')

@section('title', 'Contact us')

@section('content')
    <h1>Contact us</h1>
    @if(session()->has('message'))
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> {{ session()->get('message') }}
        </div>
    @endif
    @if(! session()->has('message'))
        <form action="{{ route('contact.store') }}" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" value="{{ old('name')}}" class="form-control">
                <div>{{ $errors->first('name') }}</div>
            </div>

            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" name="email" value="{{ old('email')}}" class="form-control">
                <div>{{ $errors->first('email') }}</div>
            </div>

            <div class="form-group">
                <label for="message">E-Mail</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
                <div>{{ $errors->first('message') }}</div>
            </div>

            @csrf

            <button type="submit" class="btn btn-primary">Send message</button>
        </form>
    @endif
@endsection