<?php

namespace Awcodes\FilamentBadgeableColumn\Components\Concerns;

use Illuminate\Support\Str;

trait HasColor
{
    protected string $color = 'default';

    public function color(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function hasHexColor(): bool
    {
        return $this->color && Str::of($this->color)->startsWith('#');
    }
}
