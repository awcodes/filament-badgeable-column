<?php

namespace Awcodes\Badger\Components;

use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Arr;

class BadgerColumn extends TextColumn
{
    protected string $view = 'badger::components.column';

    protected array|Closure $appends = [];

    protected array|Closure $prepends = [];

    protected bool|Closure $asPills = true;

    public function appends(array|Closure $badges): static
    {
        $this->appends = $badges;

        return $this;
    }

    public function asPills(bool|Closure $condition): static
    {
        $this->asPills = $condition;

        return $this;
    }

    public function prepends(array|Closure $badges): static
    {
        $this->prepends = $badges;

        return $this;
    }

    public function getAppendedBadges(): array
    {
        return $this->getBadges($this->appends);
    }

    public function getPrependedBadges(): array
    {
        return $this->getBadges($this->prepends);
    }

    public function getBadges(array $badges): array
    {
        // only evaluate the badges at the point of retrieval, to ensure the rest of the livewire component stack + needed data is available.
        $badges = $this->evaluate($badges);

        foreach ($badges as $k => $badge) {
            $badge->column($this)
                ->isPill($this->shouldBePills());
            unset($badges[$k]);
            $badges[$badge->getName()] = $badge;
        }

        return Arr::wrap($badges);
    }

    public function shouldBePills(): bool
    {
        return $this->evaluate($this->asPills);
    }
}
