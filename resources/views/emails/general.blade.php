@component('mail::message')
# {{ $mailData['title'] }}

@component('mail::button', ['url' => ''])
# {{ $mailData['body'] }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent






