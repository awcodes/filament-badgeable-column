<?php

declare(strict_types=1);

use Awcodes\BadgeableColumn\Tests\Fixtures\Livewire\PostsTable;
use Awcodes\BadgeableColumn\Tests\TestCase;
use Workbench\App\Models\Post;

use function Pest\Livewire\livewire;

uses(TestCase::class);

it('can render column', function () {
    Post::factory()->create();

    livewire(PostsTable::class)
        ->assertCanRenderTableColumn('title')
        ->assertSee('badgeable-column-badge');
});
