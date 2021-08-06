@component('mail::message')
# Perfil de cliente completado

El cliente {{ $client->full_name }} ha rellenado su perfil. Puedes verlo pinchando en el botón de abajo.

@component('mail::button', ['url' => route('clients.show', [$client])])
Ver perfil
@endcomponent

Gracias,<br>
Maria Asensi
@endcomponent
