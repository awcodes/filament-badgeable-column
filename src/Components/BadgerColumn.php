<?php

namespace Awcodes\Badger\Components;

use Awcodes\Badger\Components\Concerns\CanBePills;
use Awcodes\Badger\Components\Concerns\HasColors;
use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Arr;

class BadgerColumn extends TextColumn
{
    use CanBePills;

    protected string $view = 'badger::components.column';

    protected array|Closure $badges = [];

    public function badges(array|Closure $badges): static
    {
        $this->badges = $badges;

        return $this;
    }

    public function getBadges(): array
    {
        // only evaluate the badges at the point of retrieval, to ensure the rest of the livewire component stack + needed data is available.
        $badges = $this->evaluate($this->badges);

        foreach ($this->badges as $k => $badge) {
            $badge->column($this)
                ->isPill($this->shouldBePills());
            unset($badges[$k]);
            $badges[$badge->getName()] = $badge;
        }

        return Arr::wrap($badges);
    }
}
