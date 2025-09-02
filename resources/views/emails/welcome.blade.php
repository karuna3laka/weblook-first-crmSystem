@component('mail::message')
# Welcome, {{ $user->name }}!

Thanks for registering at **{{ config('app.name') }}**.

@component('mail::button', ['url' => url('/dashboard')])
Back To Dashboard !!!!
@endcomponent

This Mail Is For Kavindu Karunathilaka's weblook Assigment !

Thanks,<br>
Kavindu Karunathilaka<br>
{{ config('app.name') }}
@endcomponent
