@php
    use Awcodes\FilamentBadgeableColumn\Enums\BadgeSize;
@endphp

@if (! $isHidden())
    @php
        $color = $getColor();

        $size = match ($size = $getSize()) {
            BadgeSize::ExtraSmall, 'xs' => 'xs',
            BadgeSize::Small, 'sm', null => 'sm',
            BadgeSize::Medium, 'base', 'md' => 'md',
            default => $size,
        };

        $badgeClasses = \Illuminate\Support\Arr::toCssClasses([
            "badgeable-column-badge",
            match ($shouldBePill()) {
                true => 'px-2 !rounded-full',
                default => null,
            },
            match ($getFontFamily(null)) {
                'sans' => 'font-sans',
                'serif' => 'font-serif',
                'mono' => 'font-mono',
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
            }
        ]);
    @endphp

    <x-filament::badge :class="$badgeClasses" :$color :$size>{{ $getLabel() }}</x-filament::badge>
@endif
