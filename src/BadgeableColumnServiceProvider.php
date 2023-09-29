<?php

namespace Awcodes\FilamentBadgeableColumn;

use Filament\Facades\Filament;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\HtmlString;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BadgeableColumnServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-badgeable-column')
            ->hasAssets()
            ->hasViews();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('filament-badgeable-column', __DIR__ . '/../resources/dist/badgeable-column.css')
        ], 'awcodes/filament-badgeable-column');
    }
}
