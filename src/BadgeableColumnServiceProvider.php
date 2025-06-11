<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BadgeableColumnServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('badgeable-column')
            ->hasAssets()
            ->hasViews();
    }
}
