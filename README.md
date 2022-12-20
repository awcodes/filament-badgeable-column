# Filament Badgeable Column 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/filament-badgeable-column.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-badgeable-column)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/filament-badgeable-column.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-badgeable-column)

With Filament Badgeable Column you append badges to your columns.

![Light View](./images/light.png)

![Dark View](./images/dark.png)

![With Tags View](./images/with-tags.png)

## Installation

You can install the package via composer:

```bash
composer require awcodes/filament-badgeable-column
```

Optionally, you can publish the views, translations and assets using

```bash
php artisan vendor:publish --tag="filament-badgeable-column-views"
php artisan vendor:publish --tag="filament-badgeable-column-translations"
php artisan vendor:publish --tag="filament-badgeable-column-assets"
```

## Usage

### BadgeableColumn

```php
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeField;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('title')
            ->badges([
                Badge::make('front_page')
                    ->label('Front Page')
                    ->color('success')
                    ->visible(fn ($record): bool => $record->front_page),
                Badge::make('front_page_custom_color')
                    ->label('#bada55')
                    ->color('#bada55')
                    ->visible(fn ($record): bool => $record->front_page),
                Badge::make('trashed')
                    ->label('Trashed')
                    ->color('danger')
                    ->visible(fn ($record): bool => $record->deleted_at ?? false),
                BadgeField::make('status')
                    ->options([
                        'Draft' => 'Draft',
                        'Review' => 'In Review',
                        'Published' => 'Published'
                    ])
                    ->colors([
                        'gray' => 'Draft',
                        'warning' => 'Review',
                        'success' => 'Published',
                    ])
                    ->visible(fn ($record): bool => $record->status !== Status::Published->name)
            ])
            ->searchable()
            ->sortable(),
    ]);
```

### Badgeable Tags Column

This is similar to the `Badgeable Column` except it allows you to use an 
array of data to simply output badges in the column. You field must return 
an array from the record.

```php
use Awcodes\FilamentBadgeableColumn\Components\BadgeableTagsColumn;

BadgeableTagsColumn::make('tags')
    ->colors([
        'gray',
        'primary' => 'Dan',
        '#bada55' => 'Zep',
        'warning' => 'Dennis',
        '#0e7490' => 'Ryan',
    ]),
```

## Badge Shape

If you prefer to have a more "square" shape you can use the `asPills()` 
method to set the shape of the badges. The default is that each badge 
will be a pill shape.

```php
BadgeableTagsColumn::make('tags')
    ->asPills(false)
    ->colors([
        'gray',
        'primary' => 'Dan',
        '#bada55' => 'Zep',
        'warning' => 'Dennis',
        '#0e7490' => 'Ryan',
    ]),
```

## Testing

```bash
composer test
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
