<?php

declare(strict_types=1);

use Awcodes\BadgeableColumn\Tests\Fixtures\Livewire\InfolistPage;
use Awcodes\BadgeableColumn\Tests\TestCase;
use Workbench\App\Models\Post;

use function Pest\Livewire\livewire;

uses(TestCase::class);

it('can render entry', function () {
    $post = Post::factory()->create()->refresh();

    livewire(InfolistPage::class, ['post' => $post])
        ->assertSchemaComponentExists('title')
        ->assertSee('badgeable-column-badge');
});
