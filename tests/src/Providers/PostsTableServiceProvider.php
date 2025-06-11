<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Tests\Providers;

use Awcodes\BadgeableColumn\Tests\Fixtures\Livewire\PostsTable;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Livewire\Mechanisms\ComponentRegistry;

class PostsTableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component(app(ComponentRegistry::class)
            ->getName(PostsTable::class), PostsTable::class);
    }
}
