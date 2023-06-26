@if (! $isHidden())
    @php
        $color = $getColor() ?? 'gray';
        $badgeClasses = \Illuminate\Support\Arr::toCssClasses([
            "badger-badge px-2 inline-flex py-0.5",
            match ($isPill = $shouldBePill()) {
                true => 'rounded-full',
                default => 'rounded',
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
            match ($color) {
                'gray' => 'bg-gray-500/10 text-gray-700 dark:bg-gray-500/20 dark:text-gray-300',
                default => 'bg-custom-500/10 text-custom-700 dark:text-custom-500',
            },
        ]);

        $badgeStyles = \Illuminate\Support\Arr::toCssStyles([
            \Filament\Support\get_color_css_variables($color, shades: [300, 500, 700]) => $color !== 'gray',
        ]);

    @endphp
<span class="{{ $badgeClasses }}" style="{{ $badgeStyles }}">{{ $getLabel() }}</span>
@endif
