@php
    $color = $getColor();
    $isPill = $shouldBePill();
    $textColor = $getTextColor();
@endphp

@if (! $isHidden())
<span
    @class([
        'filament-badgeable-badge px-2 inline-flex  text-xs font-medium',
        match($color) {
            'primary' => 'text-primary-700 bg-primary-500/10 dark:text-primary-500',
            'secondary' => 'text-secondary-700 bg-secondary-500/10 dark:text-secondary-500',
            'success' => 'text-success-700 bg-success-500/10 dark:text-success-500',
            'warning' => 'text-warning-700 bg-warning-500/10 dark:text-warning-500',
            'danger' => 'text-danger-700 bg-danger-500/10 dark:text-danger-500',
            default => 'text-gray-700 bg-gray-500/10 dark:text-gray-500',
        },
        'text-gray-700' => $invertTextColor() && $textColor,
        'rounded py-1' => ! $isPill,
        'rounded-full py-0.5' => $isPill,
    ])
    {!! $hasHexColor() ? "style=\"background-color:" . $color . "; color:" . $textColor . " !important;\"" : null !!}
>{{ $getLabel() }}</span>
@endif
