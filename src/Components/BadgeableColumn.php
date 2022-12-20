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
        foreach ($badges as $badge) {
            $badge->column($this);
            $badge->isPill($this->shouldBePills());
            $this->badges[$badge->getName()] = $badge;
        }

        return $this;
    }

    public function getBadges(): array
    {
        return $this->badges;
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
