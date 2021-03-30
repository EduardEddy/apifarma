@component('mail::message')
# Hola! {{ $name }} {{ $last_name }}

Has solicitado actualizacion de clave de acceso al sistema

@component('mail::button', ['url' => $url])
cambiar clave
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent