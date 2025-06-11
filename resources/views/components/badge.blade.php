@use('Filament\Support\Enums\FontFamily')
@use('Filament\Support\Enums\FontWeight')
@use('Filament\Support\Enums\Size')
@use('Illuminate\Support\Arr')

@if (! $isHidden())
    @php
        $color = $getColor();

        $size = match ($size = $getSize()) {
            Size::ExtraSmall, 'xs' => 'xs',
            Size::Small, 'sm', null => 'sm',
            Size::Medium, 'base', 'md' => 'md',
            Size::Large, 'lg' => 'lg',
            Size::ExtraLarge, 'xl' => 'xl',
            default => $size,
        };

        $badgeClasses = Arr::toCssClasses([
            "badgeable-column-badge",
            match ($shouldBePill()) {
                true => 'px-2 !rounded-full',
                default => null,
            },
            match ($getFontFamily()) {
                FontFamily::Sans, 'sans' => 'font-sans',
                FontFamily::Serif, 'serif' => 'font-serif',
                FontFamily::Mono, 'mono' => 'font-mono',
                default => null,
            },
            match ($getWeight() ?? 'medium') {
                FontWeight::Thin, 'thin' => 'font-thin',
                FontWeight::ExtraLight, 'extralight' => 'font-extralight',
                FontWeight::Light, 'light' => 'font-light',
                FontWeight::Medium, 'medium' => 'font-medium',
                FontWeight::SemiBold, 'semibold' => 'font-semibold',
                FontWeight::Bold, 'bold' => 'font-bold',
                FontWeight::ExtraBold, 'extrabold' => 'font-extrabold',
                FontWeight::Black, 'black' => 'font-black',
                default => null,
            }
        ]);
    @endphp

    <x-filament::badge :class="$badgeClasses" :color="$color" :size="$size">
        {{ $getLabel() }}
    </x-filament::badge>
@endif
