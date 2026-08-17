---
title: Styling
description: Control badge shape, colour, size, font, and the separator between the badges and the column text.
---

# Styling

## Where each method belongs

This is the one thing worth getting straight before anything else on this page.

**`Badge` methods style the badges.** Colour, size, font family, and font weight are set on each `Badge`:

```php
Badge::make('hot')->color('danger')->size(Size::Small)
```

**Column methods style the column text.** `BadgeableColumn` and `BadgeableEntry` inherit `fontFamily()`, `weight()`, and `size()` from Filament's `TextColumn` and `TextEntry`, and those apply to the value itself, not to the badges beside it.

Two methods are the exception and belong on the column, because they describe the arrangement rather than an individual badge: `asPills()` and `separator()`.

## Badge shape

By default badges use Filament's standard badge shape. `asPills()` on the column or entry makes them fully rounded:

```php
use Awcodes\BadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('name')
            ->asPills(),
    ]);
```

It accepts a closure as well, so the shape can depend on state:

```php
BadgeableColumn::make('name')
    ->asPills(fn (): bool => auth()->user()->prefers_pills)
```

`asPills()` applies to every badge on that column — prefix and suffix alike. It is decided at the column level and applied to each badge as it renders, so it is not something an individual badge can opt out of.

## Separator

A separator character sits between the badges and the column text, rendered at reduced opacity so it reads as punctuation rather than content. The default is an em dash.

Use `separator()` to change it:

```php
return $table
    ->columns([
        BadgeableColumn::make('name')
            ->separator(':'),
    ]);
```

> [!NOTE]
> `separator()` is inherited from Filament, where its usual job is splitting a list value into parts. This package reads the same setting for the badge separator, so on a column that holds a list, one call drives both.

## Colour

Colour is set per badge and accepts any colour Filament recognises — a registered name such as `primary`, `success`, `danger`, `warning`, or `gray`:

```php
Badge::make('status')->color('success')
```

A closure lets the colour follow the record:

```php
Badge::make('status')
    ->color(fn (Model $record) => match ($record->status) {
        'active' => 'success',
        'inactive' => 'danger',
        default => 'warning',
    })
```

## Size

Badge size is a case of `Filament\Support\Enums\Size`:

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Filament\Support\Enums\Size;

Badge::make('hot')
    ->label('Hot')
    ->size(Size::Small)
```

| Value | Enum case |
| --- | --- |
| `xs` | `Size::ExtraSmall` |
| `sm` | `Size::Small` |
| `md` | `Size::Medium` |
| `lg` | `Size::Large` |
| `xl` | `Size::ExtraLarge` |

The matching string works too — `->size('lg')` is resolved against the same enum. Badges are `sm` when you do not set a size.

## Font family

```php
use Filament\Support\Enums\FontFamily;

Badge::make('sku')
    ->fontFamily(FontFamily::Mono)
```

`FontFamily::Sans`, `FontFamily::Serif`, and `FontFamily::Mono` are supported, as are the strings `sans`, `serif`, and `mono`. Leaving it unset inherits whatever the surrounding table uses, which is what you want for ordinary label text; mono is worth reaching for on identifiers and codes.

## Font weight

```php
use Filament\Support\Enums\FontWeight;

Badge::make('hot')
    ->label('Hot')
    ->weight(FontWeight::Bold)
```

The full `FontWeight` range is supported — `Thin`, `ExtraLight`, `Light`, `Medium`, `SemiBold`, `Bold`, `ExtraBold`, and `Black` — along with their string equivalents. Badges are `medium` when you do not set a weight.

## Putting it together

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\Size;

BadgeableColumn::make('name')
    ->asPills()
    ->separator(':')
    ->suffixBadges([
        Badge::make('sku')
            ->color('gray')
            ->size(Size::ExtraSmall)
            ->fontFamily(FontFamily::Mono),
    ])
```
