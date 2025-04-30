<x-mail::message>
# {{ $customer->lastname }},

Nous vous confirmons la bonne réception de votre demande de souscription à notre offre d'assistance voyage {{ $insurancePolicy->name }}, soumise le {{ \Carbon\Carbon::now()->format("d/m/Y") }}.
<br/>

Nous vous remercions vivement de l'intérêt que vous portez à nos services et de la confiance que vous nous accordez.
<br/>
Votre demande est actuellement en cours d'examen par nos services. Nos équipes vont maintenant étudier attentivement votre dossier afin de vérifier votre éligibilité et la conformité des informations fournies au regard de nos conditions générales de souscription.
<br/>
Nous nous efforçons de traiter les demandes dans les meilleurs délais. Vous pouvez vous attendre à recevoir une réponse de notre part concernant l'acceptation ou le refus éventuel de votre souscription dans les plus brefs délais.
<br/>
Nous vous contacterons par e-mail dès qu'une décision aura été prise.

Nous vous remercions de votre patience.,<br>

Cordialement,<br>
{{ config('app.name') }}<br>

<x-slot:header>
<x-mail::header :url="config('app.url')">
<img src="{{ url("/logo/lgoo2.png") }}" class="logo" alt="{{config('app.name')}} logo">
</x-mail::header>
</x-slot:header>
</x-mail::message>
