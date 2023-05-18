<?php

namespace Awcodes\Badger\Components\Concerns;

use Closure;
use Illuminate\Support\Str;
use Spatie\Color\Hex;

trait HasColors
{
    protected string|Closure|null $color = null;

    protected string|Closure|null $textColor = null;

    public function color(string|Closure $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function textColor(string|Closure $color): static
    {
        $this->textColor = $color;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->evaluate($this->color);
    }

    public function getTextColor(): ?string
    {
        return $this->evaluate($this->textColor);
    }

    public function hasHexColor(): bool
    {
        return $this->getColor() && Str::of($this->getColor())->startsWith('#');
    }

    public function getHexColor(): ?string
    {
        if ($this->hasHexColor()) {
            $hex = Hex::fromString($this->getColor())->toRgb();
            return implode(',', [$hex->red(), $hex->green(), $hex->blue()]);
        }

        return null;
    }

    public function invertTextColor(): bool
    {
        if ($this->hasHexColor()) {
            $hex = str_replace('#', '', $this->getColor());
            $c_r = hexdec(substr($hex, 0, 2));
            $c_g = hexdec(substr($hex, 2, 2));
            $c_b = hexdec(substr($hex, 4, 2));

            return ((($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000) > 150;
        }

        return false;
    }
}
