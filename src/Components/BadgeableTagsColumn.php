<?php

namespace Awcodes\FilamentBadgeableColumn\Components;

use Awcodes\FilamentBadgeableColumn\Components\Concerns\HasColor;
use Closure;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanFormatState;
use Filament\Tables\Columns\Concerns\HasDescription;
use Filament\Tables\Columns\Concerns\HasFontFamily;
use Filament\Tables\Columns\Concerns\HasSize;
use Filament\Tables\Columns\Concerns\HasWeight;
use stdClass;

class BadgeableTagsColumn extends Column
{
    use HasColor;
    use CanFormatState;
    use HasDescription;
    use HasFontFamily;
    use HasSize;
    use HasWeight;

    protected string $view = 'filament-badgeable-column::components.badgeable-tags-column';

    protected array | Closure $colors = [];

    protected bool | Closure $canWrap = false;

    protected array | Closure | null $badges;

    protected bool | Closure | null $asPills = true;

    protected int | null $wrapEvery = null;

    protected Column $column;

    public function colors(array | Closure $colors): static
    {
        $this->colors = $colors;

        return $this;
    }

    public function badges(array | Closure | null $badges): static
    {
        $this->badges = $badges;

        return $this;
    }

    public function wrapEvery(int|null $index): static
    {
        $this->wrapEvery = $index;

        return $this;
    }

    public function getBadges(): array
    {
        $badges = $this->evaluate($this->badges);

        foreach ($badges as $k => $badge) {
            $badge->column($this);
            unset($badges[$k]);
            $badges[$badge->getName()] = $badge;
        }

        return $badges;
    }

    public function getColors(): array
    {
        return $this->evaluate($this->colors);
    }

    public function rowIndex(bool $isFromZero = false): static
    {
        $this->getStateUsing(static function (stdClass $rowLoop) use ($isFromZero): string {
            return (string) $rowLoop->{$isFromZero ? 'index' : 'iteration'};
        });

        return $this;
    }

    public function wrap(bool | Closure $condition = true): static
    {
        $this->canWrap = $condition;

        return $this;
    }

    public function asPills(bool | Closure | null $condition): static
    {
        $this->asPills = $condition;

        return $this;
    }


    public function canWrap(): bool
    {
        return $this->evaluate($this->canWrap);
    }

    public function shouldBePills(): bool
    {
        return $this->evaluate($this->asPills);
    }

    public function getColor(string $option = null): ?string
    {
        $optionColor = 'default';

        foreach ($this->getColors() as $color => $condition) {
            if (is_numeric($color)) {
                $optionColor = $condition;
            } elseif ($condition instanceof Closure && $condition($option, [])) {
                $optionColor = $color;
            } elseif ($condition === $option) {
                $optionColor = $color;
            }
        }

        return $optionColor;
    }

    public function getWrapEvery(): ?int
    {
        return $this->wrapEvery;
    }

    protected function mutateArrayState(array $state): array
    {
        $badges = [];

        foreach ($state as $badge) {
            $badges[] = Badge::make($badge)
                ->color($this->getColor($badge))
                ->isPill($this->shouldBePills());
        }
        $this->badges($badges);

        return $state;
    }
}
