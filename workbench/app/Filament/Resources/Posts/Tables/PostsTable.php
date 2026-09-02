<?php

declare(strict_types=1);

namespace Workbench\App\Filament\Resources\Posts\Tables;

use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Workbench\App\Models\Post;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                BadgeableColumn::make('title')
                    ->searchable()
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
                TextColumn::make('content')
                    ->words(10)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
