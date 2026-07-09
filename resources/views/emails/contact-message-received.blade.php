<x-mail::message>
# Nouveau message de contact

**Nom :** {{ $contactMessage->name }}
**Email :** {{ $contactMessage->email }}
@if ($contactMessage->phone)
**Téléphone :** {{ $contactMessage->phone }}
@endif
@if ($contactMessage->subject)
**Sujet :** {{ $contactMessage->subject }}
@endif
@if ($contactMessage->cv_path)
**CV :** joint à cet e-mail ({{ $contactMessage->cv_filename }})
@endif

{{ $contactMessage->message }}

<x-mail::button :url="route('admin.messages.show', $contactMessage)">
Voir le message
</x-mail::button>

Merci,<br>
Site SFP
</x-mail::message>
