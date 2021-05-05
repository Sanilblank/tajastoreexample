@component('mail::message')
# Your one time code.

@component('mail::button', ['url' => ''])
{{$mailData['otp']}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

