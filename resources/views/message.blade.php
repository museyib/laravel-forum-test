@if(session()->has('message'))
<div class="alert alert-success"><strong>Success!</strong> {{ session()->get('message') }}</div>
@endif

@if(session()->has('warning'))
<div class="alert alert-warning"><strong>Warning!</strong> {{ session()->get('warning') }}</div>
@endif
