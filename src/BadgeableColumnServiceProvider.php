<?php

namespace Awcodes\FilamentBadgeableColumn;

use Filament\Facades\Filament;
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
        Filament::getCurrentPanel()->renderHook(
            name: 'panels::styles.after',
            hook: fn () => new HtmlString('<style>.badgeable-column-badge .truncate { overflow: visible !important; }</style>')
        );
    }
}
