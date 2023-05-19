@if (! $isHidden())
<span
    @class([
        'badger-badge px-2 inline-flex py-0.5',
        match ($isPill = $shouldBePill(null)) {
            true => 'rounded-full',
            default => 'rounded',
        },
        match ($color = $getColor(null)) {
            'danger' => 'badger-badge-color-danger text-danger-700 bg-danger-500/10 dark:text-danger-500',
            'gray', null => 'badger-badge-color-gray text-gray-700 bg-gray-500/10 dark:text-gray-300 dark:bg-gray-500/20',
            'info' => 'badger-badge-color-info text-info-700 bg-info-500/10 dark:text-info-500',
            'primary' => 'badger-badge-color-primary text-primary-700 bg-primary-500/10 dark:text-primary-500',
            'secondary' => 'badger-badge-color-secondary text-secondary-700 bg-secondary-500/10 dark:text-secondary-500',
            'success' => 'badger-badge-color-success text-success-700 bg-success-500/10 dark:text-success-500',
            'warning' => 'badger-badge-color-warning text-warning-700 bg-warning-500/10 dark:text-warning-500',
            default => null,
        },
        match ($textColor = $getTextColor()) {
            'danger' => 'text-danger-600',
            'gray' => 'text-gray-600 dark:text-gray-400',
            'info' => 'text-info-600',
            'primary' => 'text-primary-600',
            'secondary' => 'text-secondary-600',
            'success' => 'text-success-600',
            'warning' => 'text-warning-600',
            default => null,
        },
        match ($getSize(null) ?? 'xs') {
            'xs' => 'text-xs',
            'sm', null => 'text-sm',
            'base', 'md' => 'text-base',
            'lg' => 'text-lg',
            default => null,
        },
        match ($getWeight(null) ?? 'medium') {
            'thin' => 'font-thin',
            'extralight' => 'font-extralight',
            'light' => 'font-light',
            'medium' => 'font-medium',
            'semibold' => 'font-semibold',
            'bold' => 'font-bold',
            'extrabold' => 'font-extrabold',
            'black' => 'font-black',
            default => null,
        },
        match ($getFontFamily(null)) {
            'sans' => 'font-sans',
            'serif' => 'font-serif',
            'mono' => 'font-mono',
            default => null,
        },
        'text-gray-800' => $invertTextColor() && ! $textColor,
    ])
    {!! $getCustomColor() ? "style=\"background-color:rgb(" . $getCustomColor() . ", 0.6); color:" . $textColor . " !important;\"" : null !!}
>{{ $getLabel() }}</span>
@endif
