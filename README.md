# Filament Badgeable Column

[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/filament-badgeable-column.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-badgeable-column)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/filament-badgeable-column.svg?style=flat-square)](https://packagist.org/packages/awcodes/filament-badgeable-column)

With Filament Badgeable Column you append badges to your columns.

## Installation

You can install the package via composer:

```bash
composer require awcodes/filament-badgeable-column
```

## Usage

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
                    ->label('Badass')
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

You can also define the array of badges via a closure, if you want the array of badges to be based on dynamic data. The
closure should return an array of `Badge` or `BadgeField` objects, similar to above.

The example below assumes the records have a `BelongsToMany` relationship called `topics`, and shows how to display each
topic name as a badge.

```php
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeField;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;

return $table
    ->columns([
        BadgeableColumn::make('title')
            ->badges(function($record) {
                  return $record->topics->map(function($topic) {
                    return Badge::make($topic->name)->color($topic->color);
                  });
            })
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

## Wrapping

If you need to wrap the badges to keep your columns from getting too wide you can use the `wrapEvery()` method to tell the column where to break.

```php
use Awcodes\FilamentBadgeableColumn\Components\BadgeableTagsColumn;

BadgeableTagsColumn::make('tags')
    ->wrapEvery(3)
```

## Badge Shape

If you prefer to have a more "square" shape you can use the `asPills()`
method to set the shape of the badges. The default is that each badge
will be a pill shape.

```php
use Awcodes\FilamentBadgeableColumn\Components\BadgeableTagsColumn;

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

## Badge Text Color

You may customize the color of the label for a badge with the `textColor` 
method. ***This only works with custom colors***.

```php
Badge::make('front_page_custom_color')
    ->label('Badass')
    ->color('#bada55')
    ->textColor('#ff0000')
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
