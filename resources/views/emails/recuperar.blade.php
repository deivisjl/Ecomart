@component('mail::message')
# Hola {{ $user->nombres }}

Has generado una petición para recuperar tu contraseña, por favor haz click en el botón

@component('mail::button', ['url' => route('recovery', $user->token)])
Recuperar mi contraseña
@endcomponent

Gracias<br>
{{ config('app.name') }}
@endcomponent