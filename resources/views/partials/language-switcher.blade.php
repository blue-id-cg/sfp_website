<div class="lang-switch" data-lang-switch>
    <button type="button" class="lang-switch-trigger" aria-haspopup="true" aria-expanded="false" data-lang-trigger>
        {{ strtoupper(app()->getLocale()) }} <i class="hgi-stroke hgi-arrow-down-01"></i>
    </button>
    <div class="lang-switch-menu" data-lang-menu hidden>
        @foreach (config('app.available_locales') as $code => $label)
            <a href="{{ route('lang.switch', $code) }}" class="lang-switch-option @if(app()->getLocale() === $code) active @endif">{{ $label }}</a>
        @endforeach
    </div>
</div>
