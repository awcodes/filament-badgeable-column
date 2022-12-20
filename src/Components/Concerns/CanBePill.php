<?php

namespace Awcodes\FilamentBadgeableColumn\Components\Concerns;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;

trait CanBePill
{
    use EvaluatesClosures;

    protected bool|Closure|null $shouldBePill = true;

    public function isPill(bool|Closure|null $condition): static
    {
        $this->shouldBePill = $condition;

        return $this;
    }

    public function shouldBePill(): bool
    {
        return $this->evaluate($this->shouldBePill);
    }
}
