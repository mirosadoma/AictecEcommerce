@component('mail::message')
# {{ $mailData['title'] }}

@component('mail::panel')
customer :-         {{ $mailData['customer'] }} <br>
branch   :-         {{ $mailData['branch'] }} <br>
city     :-         {{ $mailData['city'] }} <br>
order date :-       {{ $mailData['order_date'] }} <br>
delivery date :-    {{ $mailData['delivery_date'] }} <br>
delivery time  :-   {{ $mailData['delivery_time'] }} <br>
total     :-        {{ $mailData['total'] }} <br>
employee :-         {{ $mailData['employee'] }} <br>
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
