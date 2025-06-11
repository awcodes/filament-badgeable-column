![badgeable-column-og](https://res.cloudinary.com/aw-codes/image/upload/w_1200,f_auto,q_auto/plugins/badgeable-column/awcodes-badgeable-column.jpg)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/filament-badgeable-column.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-badgeable-column)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/filament-badgeable-column.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-badgeable-column)

# Badgeable Column

Easily add badges to your Filament tables with the Badgeable Column plugin. This package allows you to display badges as suffixes or prefixes in your table columns, enhancing the visual representation of data.

## Compatibility

| Package Version | Filament Version |
|-----------------|------------------|
| 1.x             | 2.x              |
| 2.x             | 3.x              |
| 3.x             | 4.x              |

## Upgrading from v2 to v3

If you are upgrading from version 2 to version 3, you will need to update the namespace anywhere you are using the plugin from `Awcodes\FilamentBadgeableColumn` to `Awcodes\BadgeableColumn`.

## Installation

You can install the package via composer:

```bash
composer require awcodes/filament-badgeable-column
```

> [!IMPORTANT]
> If you have not set up a custom theme and are using Filament Panels follow the instructions in the [Filament Docs](https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme) first. The following applies to both the Panels Package and the standalone Tables package.

After setting up a custom theme add the plugin's views to your theme css file or your app's css file if using the standalone tables package.

```css
@source '../../../../vendor/awcodes/filament-badgeable-column/resources/**/*.blade.php';
```

## Usage

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('name')
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
            ->suffixBadges([
                Badge::make('hot')
                    ->label('Hot')
                    ->color('danger')
                    ->visible(fn(Model $record) => $record->qty < 5),
            ]),
    ]);
```

You can also define the array of badges via a closure, if you want the array of badges to be based on dynamic data. The closure should return an array of `Badge` objects, similar to above.

The example below assumes the records have a `BelongsToMany` relationship called `topics`, and shows how to display each topic name as a badge.

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;

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

## Badge Shape

If you prefer to have a more "rounded" shape you can use the `asPills()` method to set the shape of the badges.

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('name')
            ->asPills()
    ]);
```

## Separator

The default separator between the column text and the badges is '&mdash;'. If you would like to use a different separator, use the `separator()` method to set a character to be used as a separator.

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('name')
            ->separator(':')
    ]);
```

## Font Family

If you would like to use a different font family for the badges, you can use the `fontFamily()` method to set the font family.

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;
use Filament\Support\Enums\FontFamily;

return $table
    ->columns([
        BadgeableColumn::make('name')
            ->fontFamily(FontFamily::Mono)
    ]);
```

## Font Weight

If you would like to use a different font weight for the badges, you can use the `weight()` method to set the font weight.

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;
use Filament\Support\Enums\FontWeight;

return $table
    ->columns([
        BadgeableColumn::make('name')
            ->weight(FontWeight::Bold)
    ]);
```

## Size

If you would like to use a different size for the badges, you can use the `size()` method to set the size.

```php
use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;
use Filament\Support\Enums\Size;

return $table
    ->columns([
        BadgeableColumn::make('name')
            ->size(Size::Small)
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
