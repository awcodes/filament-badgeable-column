<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Components;

use Closure;
use Filament\Infolists\Components\Entry;
use Filament\Support\Components\ViewComponent;
use Filament\Support\Concerns\HasColor;
use Filament\Support\Concerns\HasFontFamily;
use Filament\Support\Concerns\HasWeight;
use Filament\Support\Enums\Size;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanBeHidden;
use Filament\Tables\Columns\Concerns\HasLabel;
use Filament\Tables\Columns\Concerns\HasName;
use Filament\Tables\Columns\Concerns\HasRecord;
use Illuminate\Database\Eloquent\Model;

class Badge extends ViewComponent
{
    use CanBeHidden;
    use HasColor;
    use HasFontFamily;
    use HasLabel;
    use HasName;
    use HasRecord;
    use HasWeight;

    protected string $view = 'badgeable-column::components.badge';

    protected Column|Entry $column;

    protected bool|Closure|null $shouldBePill = true;

    protected Size|string|Closure|null $size = null;

    final public function __construct(string $name)
    {
        $this->name($name);
    }

    public static function make(string $name): static
    {
        $static = app(static::class, ['name' => $name]);
        $static->configure();

        return $static;
    }

    public function isPill(bool|Closure|null $condition): static
    {
        $this->shouldBePill = $condition;

        return $this;
    }

    public function size(Size|string|Closure|null $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function column(Column|Entry $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function getSize(): Size|string|null
    {
        $size = $this->evaluate($this->size);

        if (! is_string($size)) {
            return $size;
        }

        return Size::tryFrom($size) ?? $size;
    }

    public function getRecord(): ?Model
    {
        return $this->column->getRecord();
    }

    public function shouldBePill(): bool
    {
        return (bool) $this->evaluate($this->shouldBePill);
    }

    protected function resolveDefaultClosureDependencyForEvaluationByName(string $parameterName): array
    {
        return match ($parameterName) {
            'record' => [$this->getRecord()],
            'state' => [$this->getLabel()],
            default => parent::resolveDefaultClosureDependencyForEvaluationByName($parameterName),
        };
    }
}
