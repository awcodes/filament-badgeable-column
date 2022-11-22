<?php

namespace Awcodes\FilamentBadgeableColumn;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class BadgeableColumnServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-badgeable-column';

    protected array $styles = [
        'plugin-filament-badgeable-column' => __DIR__.'/../resources/dist/filament-badgeable-column.css',
    ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasAssets()
            ->hasViews()
            ->hasTranslations();
    }
}
