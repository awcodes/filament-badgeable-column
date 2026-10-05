<?php

declare(strict_types=1);

use Awcodes\Focus\Card;
use Awcodes\Focus\Enums\Size;
use Awcodes\Focus\Enums\Theme;
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

        // The share-image source, shaped to the card templates' screenshot slot. Cards render dark.
        Screenshot::make('card-table')
            ->viewportSize(...$cardTable)
            ->visit('/admin/posts')
            ->viewport()
            ->themes([Theme::Dark]),
    ])
    ->cardTemplates('https://github.com/awcodes/focus-templates/tree/v1.1.0/dist')
    ->cards([
        // Open Graph and the GitHub social preview share one 2400x1260 template; GitHub crops 30px top and bottom.
        Card::make('social')
            ->template('one-up-wide')
            ->title('Badgeable Column')
            ->screenshots(['card-table'])
            ->sizes([Size::OpenGraph, Size::GitHubSocial]),

        // The Filament plugin directory's 2560x1440 thumbnail. One-up, like the social card: in the two-up template
        // the second slot sits behind the first, which hid the entry's suffix badge.
        Card::make('thumbnail')
            ->template('one-up')
            ->title('Badgeable Column')
            ->screenshots(['card-table'])
            ->sizes([Size::Filament]),
    ]);
