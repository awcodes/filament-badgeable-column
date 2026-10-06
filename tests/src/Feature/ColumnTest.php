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

it('keeps badge groups from shrinking below their content width', function () {
    Post::factory()->create();

    // Filament's badges truncate their labels, so without a minimum width a squeezed table clips them.
    livewire(PostsTable::class)
        ->assertSeeHtml('margin-inline-end:0.25rem;min-width:max-content;')
        ->assertSeeHtml('margin-inline-start:0.25rem;min-width:max-content;');
});
