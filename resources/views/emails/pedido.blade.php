@component('mail::message')
# Hola {{ $user->nombres }}

Esta es una notificación de confirmación de pedido, en breve procesaremos tu solicitud

Gracias<br>
{{ config('app.name') }}
@endcomponent
