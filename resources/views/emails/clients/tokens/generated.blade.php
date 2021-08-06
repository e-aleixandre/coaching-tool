@component('mail::message')
# Hola,

He creado tu perfil de cliente y necesito que rellenes algunos datos de tu ficha para tenerla disponible en nuestras sesiones. No te llevará más de unos minutos.

@component('mail::button', ['url' => route('client_tokens.complete_profile', [ 'clientToken' => $token ])])
Rellenar ficha
@endcomponent

Gracias,<br>
Maria Asensi
{{-- {{ config('app.name') }} --}}
@endcomponent
