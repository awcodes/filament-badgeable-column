<?php

declare(strict_types=1);

namespace Workbench\App\Filament\Resources\Posts\Schemas;

use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Workbench\App\Models\Post;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                BadgeableEntry::make('title')
                    ->prefixBadges([
                        Badge::make('category')
                            ->label(fn (Post $record): ?string => $record->category)
                            ->color('gray')
                            ->hidden(fn (Post $record): bool => blank($record->category)),
                    ])
                    ->suffixBadges([
                        Badge::make('is_published')
                            ->label(fn (Post $record): string => $record->is_published ? 'Published' : 'Draft')
                            ->color(fn (Post $record): string => $record->is_published ? 'success' : 'warning'),
                    ]),
                TextEntry::make('content')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
