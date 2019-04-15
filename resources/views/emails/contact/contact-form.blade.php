@component('mail::message')
# Thank your for your message
    <strong>Name: </strong> {{ $data['name'] }}
    <strong>E-Mail: </strong> {{ $data['email'] }}

    <strong>Message: </strong>

    {{ $data['message'] }}
@endcomponent
