@component('mail::message')
<b>You have received a customer message</b><br><hr>
Customer name: <b>{{$mailData['fullname']}}</b><br>
Customer Email: <b>{{$mailData['customeremail']}}</b><br>
Message:

<p>{{$mailData['message']}}</p>

@endcomponent
