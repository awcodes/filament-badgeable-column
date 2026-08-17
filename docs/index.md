---
title: Badgeable Column
description: Display additional context as badges alongside a Filament table column or infolist entry.
---

# Badgeable Column

Badgeable Column adds badges to either side of a Filament text value. A product name can carry its stock status, a post title can carry its topics, an order reference can carry a "rush" flag — without giving each one a column of its own.

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;

BadgeableColumn::make('title')
    ->suffixBadges([
        Badge::make('featured')->color('primary'),
    ])
```

## Two components

The package ships two components, both of which behave exactly like the Filament component they extend:

| Component | Extends | Use in |
| --- | --- | --- |
| `BadgeableColumn` | `Filament\Tables\Columns\TextColumn` | Tables |
| `BadgeableEntry` | `Filament\Infolists\Components\TextEntry` | Infolists |

Because they are subclasses, everything you already know applies — `searchable()`, `sortable()`, `words()`, `copyable()`, and the rest are all still available. The badges are additive.

## Prefix and suffix

Badges attach on either side of the value. `prefixBadges()` puts them before it, `suffixBadges()` after, and a separator character sits between the badges and the text. Both accept a fixed array or a closure that builds one from the record.

See [Usage](usage.md) for both, and [Styling](styling.md) for badge shape, colour, size, and the separator.

## Next steps

Start with [Installation](installation.md). The package ships Blade views that your Tailwind build needs to see, so there is one step beyond `composer require`.
