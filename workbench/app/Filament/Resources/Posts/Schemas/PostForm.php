<?php

declare(strict_types=1);

namespace Workbench\App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('content')
                    ->columnSpanFull(),
                TextInput::make('category'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
