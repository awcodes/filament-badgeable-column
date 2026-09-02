<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Tests\Fixtures\Livewire;

use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;
use Exception;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Component;
use Workbench\App\Models\Post;

class PostsTable extends Component implements HasActions, HasSchemas, Tables\Contracts\HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use Tables\Concerns\InteractsWithTable;

    /** @throws Exception */
    public function table(Table $table): Table
    {
        return $table
            ->query(Post::query())
            ->columns([
                BadgeableColumn::make('title')
                    ->searchable()
                    ->prefixBadges([
                        Badge::make('featured')
                            ->color('primary'),
                    ])
                    ->suffixBadges([
                        Badge::make('status')
                            ->color('primary'),
                    ]),
                Tables\Columns\TextColumn::make('content')
                    ->words(10)
                    ->searchable(isIndividual: true, isGlobal: false),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public function render(): string
    {
        return <<<'BLADE'
		{{ $this->table }}
		BLADE;
    }
}
