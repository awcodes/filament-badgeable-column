@php
    $color = $getColor();
@endphp

@if (! $isHidden())
<div class="filament-badgeable-column-badge inline-flex gap-1">
    <span class="opacity-50">&mdash;</span>
    <strong
        @class([
            'filament-badgeable-column-badge px-2 rounded py-1 text-xs',
            'text-primary-700 bg-primary-500/10 dark:text-primary-500' => $color === 'primary',
            'text-secondary-700 bg-secondary-500/10 dark:text-secondary-500' => $color === 'secondary',
            'text-success-700 bg-success-500/10 dark:text-success-500' => $color === 'success',
            'text-warning-700 bg-warning-500/10 dark:text-warning-500' => $color === 'warning',
            'text-danger-700 bg-danger-500/10 dark:text-danger-500' => $color === 'danger',
            'text-gray-700 bg-gray-500/10 dark:text-gray-300 dark:bg-gray-500/20' => $color === 'default',
        ])
        {!! $hasHexColor() ? "style=\"background-color:" . $color . ";\"" : null !!}
    >{{ $getLabel() }}</strong>
</div>
@endif
