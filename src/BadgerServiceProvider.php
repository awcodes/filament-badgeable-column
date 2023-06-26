<?php

namespace Awcodes\Badger;

use Filament\Support\Assets\AssetManager;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BadgerServiceProvider extends PackageServiceProvider
{
    public static string $name = 'badger';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasAssets()
            ->hasViews();
    }

    public function packageRegistered(): void
    {
        if ($this->app->runningInConsole()) {
            $this->app->resolving(AssetManager::class, function () {
                FilamentAsset::register([
                    Css::make(static::$name, __DIR__ . '/../resources/dist/badger.css'),
                ], static::$name);
            });
        }
    }
}
