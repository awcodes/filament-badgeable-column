<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Tests\Fixtures\Livewire;

use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableEntry;
use Exception;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Livewire\Component;

class InfolistPage extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public $post;

    public static function make(): static
    {
        return new static;
    }

    public function mount(): void
    {
        //
    }

    /** @throws Exception */
    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->record($this->post)
            ->components([
                BadgeableEntry::make('title')
                    ->prefixBadges([
                        Badge::make('featured')
                            ->color('primary'),
                    ])
                    ->suffixBadges([
                        Badge::make('status')
                            ->color('primary'),
                    ]),
            ]);
    }

    public function render(): string
    {
        return <<<'BLADE'
		{{ $this->infolist }}
		BLADE;
    }
}
