<?php

namespace Awcodes\Badger\Components\Concerns;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;

trait CanBePills
{
    protected bool | Closure | null $asPills = true;

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
