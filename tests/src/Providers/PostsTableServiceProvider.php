<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Tests\Providers;

use Awcodes\BadgeableColumn\Tests\Fixtures\Livewire\PostsTable;
use Illuminate\Support\ServiceProvider;
use Livewire\Finder\Finder;
use Livewire\Livewire;
use Livewire\Mechanisms\ComponentRegistry;

class PostsTableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (class_exists(ComponentRegistry::class)) {
            Livewire::component(
                name: app(ComponentRegistry::class)->getName(PostsTable::class),
                class: PostsTable::class
            );
        } else {
            [$namespace, $componentName] = app(Finder::class)->parseNamespaceAndName(PostsTable::class);

            Livewire::component($componentName, PostsTable::class);
        }
    }
}
