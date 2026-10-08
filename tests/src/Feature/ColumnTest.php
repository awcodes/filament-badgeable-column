<?php

declare(strict_types=1);

use Awcodes\BadgeableColumn\Tests\Fixtures\Livewire\PostsTable;
use Awcodes\BadgeableColumn\Tests\Fixtures\Models\Post;
use Awcodes\BadgeableColumn\Tests\TestCase;

use function Pest\Livewire\livewire;

uses(TestCase::class);

it('can render column', function () {
    Post::factory()->create();

    livewire(PostsTable::class)
        ->assertCanRenderTableColumn('title')
        ->assertSee('badgeable-column-badge');
});

it('renders the column prefix and suffix alongside badges', function () {
    $post = Post::factory()->create();

    livewire(PostsTable::class)
        ->assertSee('Post:')
        ->assertSee('('.mb_strlen($post->title).' chars)')
        ->assertSee('badgeable-column-badge');
});
