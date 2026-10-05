<?php

declare(strict_types=1);

use Awcodes\Focus\Card;
use Awcodes\Focus\Enums\Size;
use Awcodes\Focus\Screenshot;
use Awcodes\Focus\ScreenshotSuite;

/*
 * Documentation screenshots for Badgeable Column, generated with awcodes/focus from the
 * Workbench (run `composer build` first). The Workbench seeds six fixed posts, so the
 * badges are the same on every build.
 */

// The awcodes card templates frame each screenshot at 1400x816. The table needs that full width, or the title
// column is too narrow for its badges.
$cardTable = [1400, 816];

return ScreenshotSuite::make()
    ->screenshots([
        Screenshot::make('table')
            ->visit('/admin/posts')
            ->focus('[data-focus="posts-table"]'),

        Screenshot::make('entry')
            ->visit('/admin/posts/1')
            ->focus('[data-focus="title-entry"]')
            ->minSize(720, 120),

        // The share-image source, shaped to the card templates' screenshot slots. The two-up templates show it
        // dark in slot 1 and light in slot 2, so it is captured in both themes.
        Screenshot::make('card-table')
            ->viewportSize(...$cardTable)
            ->visit('/admin/posts')
            ->viewport(),
    ])
    ->cardTemplates('https://github.com/awcodes/focus-templates/tree/v2.1.0/dist')
    ->cards([
        // Open Graph and the GitHub social preview share one 2400x1260 template; GitHub crops 30px top and bottom.
        Card::make('social')
            ->template('two-up-wide')
            ->title('Badgeable Column')
            ->screenshots(['card-table', 'card-table'])
            ->sizes([Size::OpenGraph, Size::GitHubSocial]),

        // The Filament plugin directory's 2560x1440 thumbnail.
        Card::make('thumbnail')
            ->template('two-up')
            ->title('Badgeable Column')
            ->screenshots(['card-table', 'card-table'])
            ->sizes([Size::Filament]),

        // Unbranded 16:9 image for aw.codes, which adds its own heading: the same screenshots, no text or logo.
        Card::make('plain')
            ->template('two-up-plain')
            ->screenshots(['card-table', 'card-table'])
            ->sizes([[2560, 1440]])
            ->scale(1),
    ]);
