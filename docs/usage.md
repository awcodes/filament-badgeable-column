---
title: Usage
description: Attach badges to a table column or infolist entry, from a fixed array or a closure.
---

# Usage

## In a table

Swap `TextColumn` for `BadgeableColumn` and add badges to either side of the value:

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('name')
            ->prefixBadges([
                Badge::make('brand_name')
                    ->label(fn (Model $record) => $record->status)
                    ->color(function (Model $record) {
                        return match ($record->status) {
                            'active' => 'success',
                            'inactive' => 'danger',
                            default => 'warning',
                        };
                    }),
            ])
            ->suffixBadges([
                Badge::make('hot')
                    ->label('Hot')
                    ->color('danger')
                    ->visible(fn (Model $record) => $record->qty < 5),
            ]),
    ]);
```

`BadgeableColumn` extends Filament's `TextColumn`, so every method you would normally reach for still works alongside the badges:

```php
BadgeableColumn::make('title')
    ->searchable()
    ->sortable()
    ->suffixBadges([
        Badge::make('featured')->color('primary'),
    ])
```

## In an infolist

`BadgeableEntry` is the same thing for infolists, extending `TextEntry`:

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableEntry;

return $schema
    ->components([
        BadgeableEntry::make('title')
            ->prefixBadges([
                Badge::make('featured')->color('primary'),
            ])
            ->suffixBadges([
                Badge::make('status')->color('primary'),
            ]),
    ]);
```

Both components take the same badge methods, so everything on this page and in [Styling](styling.md) applies equally to either one.

## Defining a badge

`Badge::make()` takes a name. If you set no label, the name is turned into one — `Badge::make('brand_name')` renders as "Brand name".

```php
Badge::make('featured')
```

Set a label explicitly when you want different text, or text derived from the record:

```php
Badge::make('status')
    ->label(fn (Model $record) => $record->status)
```

Closures passed to a badge can receive `$record`, the model for the row, and `$state`, the badge's own label:

```php
Badge::make('qty')
    ->label(fn (Model $record) => "{$record->qty} left")
    ->color(fn (Model $record) => $record->qty < 5 ? 'danger' : 'gray')
```

Badges can be hidden per record, which removes them entirely rather than leaving a gap:

```php
Badge::make('hot')
    ->label('Hot')
    ->visible(fn (Model $record) => $record->qty < 5)
```

## Building badges from data

Both `prefixBadges()` and `suffixBadges()` accept a closure instead of an array, for when the set of badges is not known up front. The closure returns a collection or array of `Badge` objects.

This example assumes each record has a `BelongsToMany` relationship called `topics`, and renders one badge per topic:

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('title')
            ->suffixBadges(function ($record) {
                return $record->topics->map(function ($topic) {
                    return Badge::make($topic->name)->color($topic->color);
                });
            })
            ->searchable()
            ->sortable(),
    ]);
```

> [!TIP]
> A closure that walks a relationship runs once per row. Eager-load it on the table's query to avoid an N+1 — `->modifyQueryUsing(fn ($query) => $query->with('topics'))`.

## Next steps

See [Styling](styling.md) to change badge shape, size, font, and the separator between the badges and the text.
