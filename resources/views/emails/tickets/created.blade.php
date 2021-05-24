@component('mail::message')
# Hi!

Your ticket has been created

@component('mail::button', ['url' => ''])
Go to our website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
