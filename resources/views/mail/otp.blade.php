<x-mail::message>
# Bonjour {{ $customer->name }},

Pour des raisons de sécurité, nous avons généré un code OTP (One-Time Password) pour votre authentification. Veuillez utiliser le code ci-dessous pour compléter votre processus de connexion:

<center>Votre code OTP : <strong style="color: #00a7bc;font-size: 16px">{{ $customer->otp }}</strong></center> <br><br>


Ce code est valable pour une durée de 10 minutes. Si vous n'avez pas initié cette demande, veuillez ignorer cet email et contacter notre support client immédiatement.

Merci de votre confiance,<br>

Cordialement,<br>
{{ config('app.name') }}<br>

<x-slot:header>
<x-mail::header :url="config('app.url')">
<img src="{{ url("/logo/lgoo2.png") }}" class="logo" alt="{{config('app.name')}} logo">
</x-mail::header>
</x-slot:header>
</x-mail::message>
