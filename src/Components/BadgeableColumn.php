<?php

namespace Awcodes\FilamentBadgeableColumn\Components;

use Closure;
use Filament\Tables\Columns\TextColumn;

class BadgeableColumn extends TextColumn
{
    protected string $view = 'filament-badgeable-column::components.badgeable-column';

    protected array | Closure | null $badges;

    public function badges(array | Closure | null $badges): static
    {
        foreach ($badges as $badge) {
            $badge->column($this);
            $this->badges[$badge->getName()] = $badge;
        }

        return $this;
    }

    public function getBadges(): array
    {
        return $this->badges;
    }
}
