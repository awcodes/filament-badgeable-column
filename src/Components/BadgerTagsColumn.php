<?php

namespace Awcodes\Badger\Components;

use Awcodes\Badger\Components\Concerns\CanBePills;
use Closure;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanFormatState;
use Filament\Tables\Columns\Concerns\HasColor;
use Filament\Tables\Columns\Concerns\HasDescription;
use Filament\Tables\Columns\Concerns\HasFontFamily;
use Filament\Tables\Columns\Concerns\HasSize;
use Filament\Tables\Columns\Concerns\HasWeight;

class BadgerTagsColumn extends Column
{
    use CanFormatState;
    use HasColor;
    use HasDescription;
    use HasFontFamily;
    use HasSize;
    use HasWeight;

    protected string $view = 'badger::components.tags-column';

    protected bool | Closure $canWrap = false;

    protected array | Closure | null $badges = null;

    protected int | null $wrapEvery = null;

    protected Column $column;

    public function wrapEvery(int $index): static
    {
        $this->wrapEvery = $index;

        return $this;
    }

    public function formatState(mixed $state): array
    {
        $badges = [];

        foreach ($state as $badge) {
            $badges[] = Badge::make($badge)
                ->color($this->getColor($badge))
                ->size($this->getSize($badge))
                ->fontFamily($this->getFontFamily($badge))
                ->weight($this->getWeight($badge))
                ->isPill($this->shouldBePills());
        }

        return $badges ?? [];
    }

    public function canWrap(): bool
    {
        return $this->evaluate($this->canWrap);
    }

    public function getWrapEvery(): ?int
    {
        return $this->wrapEvery;
    }
}
