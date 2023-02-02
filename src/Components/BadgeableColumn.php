<?php

namespace Awcodes\FilamentBadgeableColumn\Components;

use Closure;
use Filament\Tables\Columns\TextColumn;

class BadgeableColumn extends TextColumn
{
    protected string $view = 'filament-badgeable-column::components.badgeable-column';

    protected array | Closure | null $badges;

    protected bool | Closure | null $asPills = true;

    public function badges(array | Closure | null $badges): static
    {
        $this->badges = $badges;

        return $this;
    }

    public function getBadges(): array
    {
        // only evaluate the badges at the point of retrieval, to ensure the rest of the livewire component stack + needed data is available.
        $badges = $this->evaluate($this->badges);

        foreach ($this->badges as $k => $badge) {
            $badge->column($this);
            $badge->isPill($this->shouldBePills());
            unset($badges[$k]);
            $badges[$badge->getName()] = $badge;
        }

        return $badges;
    }

    public function asPills(bool | Closure | null $condition): static
    {
        $this->asPills = $condition;

        return $this;
    }

    public function shouldBePills(): bool
    {
        return $this->evaluate($this->asPills);
    }
}
