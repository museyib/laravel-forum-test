@extends('layouts.app')

@section('title', 'Customer list')

@section('content')
	<div class="row">

	@if(session()->has('message'))
		<div class="alert alert-success" role="alert">
			<strong>Success!</strong> {{ session()->get('message') }}
		</div>
	@endif

		<div class="col-12">
			<h1>Customer list</h1>
			<p><a href="{{ route('customers.create') }}">Add new customer</a></p>
		</div>
	</div>

	@foreach($customers as $customer)
		<div class="row">
			<div class="col-2">{{ $customer->id }}</div>
			<div class="col-4">
				<a href="/customers/{{$customer->id}}">{{ $customer->name }}</a>
			</div>
			<div class="col-4">{{ $customer->company->name }}</div>
			<div class="col-2">{{ $customer->active	 }}</div>
		</div>
	@endforeach

@endsection