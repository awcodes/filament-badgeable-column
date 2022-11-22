@php
    $state = $getFormattedState();
@endphp

<div
    {{ $attributes->merge($getExtraAttributes())->class([
        'px-4 py-3 flex filament-title-status-column',
        match ($getAlignment()) {
            'left' => 'justify-start',
            'center' => 'justify-center',
            'right' => 'justify-end',
            default => null
        },
        'whitespace-normal' => $canWrap(),
    ]) }}
>
    @if (filled($state))
        <div>
            {{ $state }}
            @foreach ($getBadges() as $badge)
                {{ $badge }}
            @endforeach
        </div>
    @endif
</div>
