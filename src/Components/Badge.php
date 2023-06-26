<?php

namespace Awcodes\Badger\Components;

use Closure;
use Filament\Support\Components\ViewComponent;
use Filament\Support\Concerns\HasColor;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanBeHidden;
use Filament\Tables\Columns\Concerns\HasLabel;
use Filament\Tables\Columns\Concerns\HasName;
use Filament\Tables\Columns\Concerns\HasRecord;
use Filament\Tables\Columns\Concerns\HasFontFamily;
use Filament\Tables\Columns\Concerns\HasSize;
use Filament\Tables\Columns\Concerns\HasWeight;
use Illuminate\Database\Eloquent\Model;

class Badge extends ViewComponent
{
    use CanBeHidden;
    use HasColor;
    use HasLabel;
    use HasName;
    use HasRecord;
    use HasFontFamily;
    use HasSize;
    use HasWeight;

    protected string $view = 'badger::components.badge';

    protected Column $column;

    protected bool | Closure | null $shouldBePill = true;

    final public function __construct(string $name)
    {
        $this->name($name);
    }

    public static function make(string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    public function isPill(bool | Closure | null $condition): static
    {
        $this->shouldBePill = $condition;

        return $this;
    }

    public function column(Column $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function getRecord(): ?Model
    {
        return $this->column->getRecord();
    }

    protected function resolveDefaultClosureDependencyForEvaluationByName(string $parameterName): array
    {
        return match ($parameterName) {
            'record' => [$this->getRecord()],
            'state' => [$this->getLabel()],
            default => parent::resolveDefaultClosureDependencyForEvaluationByName($parameterName),
        };
    }

    public function shouldBePill(): bool
    {
        return $this->evaluate($this->shouldBePill);
    }
}
