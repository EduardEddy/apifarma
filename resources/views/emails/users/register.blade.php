@component('mail::message')
# Hola! {{ $name }} {{ $last_name }}

Solo debes activasr tu cuenta haciendo click en el boton!

@component('mail::button', ['url' => $url])
Activar cuenta
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent