@component('mail::message')
# Hola {{ $user->name }}

Gracias por crear un cuenta. Por favor verifícala usando el siguiente botón:

@component('mail::button', ['url' => route('verificar', $user->token)])
Confirmar mi cuenta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent