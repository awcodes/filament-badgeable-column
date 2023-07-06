<?php

namespace Awcodes\FilamentBadgeableColumn;

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
}
