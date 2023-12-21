# Filament Badgeable Column

[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/filament-badgeable-column.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-badgeable-column)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/filament-badgeable-column.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-badgeable-column)

![badgeable-column-og](https://res.cloudinary.com/aw-codes/image/upload/w_1200,f_auto,q_auto/plugins/badgeable-column/awcodes-badgeable-column.jpg)

With Filament Badgeable Column you prepend and append badges to your columns.

## Installation

You can install the package via composer:

```bash
composer require awcodes/filament-badgeable-column
```

In an effort to align with Filament's theming methodology you will need to use a custom theme to use this plugin.

> **Note**
> If you have not set up a custom theme and are using a Panel follow the instructions in the [Filament Docs](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme) first. The following applies to both the Panels Package and the standalone Forms package.

Add the plugin's views to your `tailwind.config.js` file.

```js
content: [
    '<path-to-vendor>/awcodes/filament-badgeable-column/resources/**/*.blade.php',
]
```

## Usage

```php
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('name')
            ->suffixBadges([
                Badge::make('hot')
                    ->label('Hot')
                    ->color('danger')
                    ->visible(fn(Model $record) => $record->qty < 5),
            ])
            ->prefixBadges([
                Badge::make('brand_name')
                    ->label(fn(Model $record) => $record->status)
                    ->color(function(Model $record) {
                        return match ($record->status) {
                            'active' => 'success',
                            'inactive' => 'danger',
                            default => 'warning',
                        };
                    })
            ])
    ]);
```

You can also define the array of badges via a closure, if you want the array of badges to be based on dynamic data. The closure should return an array of `Badge` objects, similar to above.

The example below assumes the records have a `BelongsToMany` relationship called `topics`, and shows how to display each topic name as a badge.

```php
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('title')
            ->suffixBadges(function($record) {
                  return $record->topics->map(function($topic) {
                    return Badge::make($topic->name)->color($topic->color);
                  });
            })
            ->searchable()
            ->sortable(),
    ]);
```

## Badgeable Tags Column

> **Warning**
> The Badgeable Tags Column has been deprecated please use the `TextColumn` `badge()` method instead.

## Badge Shape

If you prefer to have a more "rounded" shape you can use the `asPills()`
method to set the shape of the badges.

```php
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('name')
            ->asPills()
    ]);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [awcodes](https://github.com/awcodes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
