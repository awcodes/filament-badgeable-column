@php
    $color = $getColor();
@endphp

@if (! $isHidden())
<span
    @class([
        'filament-badgeable-badge px-2 inline-flex rounded py-1 text-xs font-medium',
        'text-primary-800 bg-primary-500/20 dark:text-primary-400' => $color === 'primary',
        'text-secondary-800 bg-secondary-500/20 dark:text-secondary-400' => $color === 'secondary',
        'text-success-800 bg-success-500/20 dark:text-success-400' => $color === 'success',
        'text-warning-800 bg-warning-500/20 dark:text-warning-400' => $color === 'warning',
        'text-danger-800 bg-danger-500/20 dark:text-danger-400' => $color === 'danger',
        'text-gray-800 bg-gray-500/20 dark:text-gray-300' => $color === 'default' || $color === 'gray',
        'text-gray-800' => $invertTextColor(),
    ])
    {!! $hasHexColor() ? "style=\"background-color:" . $color . ";\"" : null !!}
>{{ $getLabel() }}</span>
@endif
