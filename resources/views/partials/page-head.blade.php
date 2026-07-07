@php
    /** @var array<int, array{label: string, url: ?string}> $breadcrumbs */
@endphp

<header class="page-head">
    <img src="{{ asset('images/opt/' . ($image ?? 'crew-platform') . '.jpg') }}" alt="" aria-hidden="true" />
    <div class="wrap">
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            @foreach ($breadcrumbs as $index => $crumb)
                @if ($crumb['url'])
                    <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                @else
                    <span>{{ $crumb['label'] }}</span>
                @endif
                @unless ($loop->last)
                    <i class="fas fa-chevron-right"></i>
                @endunless
            @endforeach
        </nav>
        @isset($kicker)
            <span class="kicker on-dark" data-index="{{ $kickerIndex ?? '//' }}">{{ $kicker }}</span>
        @endisset
        <h1>{{ $title }}</h1>
        @isset($lead)
            <p class="lead">{{ $lead }}</p>
        @endisset
    </div>
</header>
