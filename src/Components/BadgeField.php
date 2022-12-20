<?php

namespace Awcodes\FilamentBadgeableColumn\Components;

use Awcodes\FilamentBadgeableColumn\Components\Concerns\CanBePill;
use Awcodes\FilamentBadgeableColumn\Components\Concerns\HasColor;
use Closure;
use Filament\Support\Components\ViewComponent;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanBeHidden;
use Filament\Tables\Columns\Concerns\HasName;
use Filament\Tables\Columns\Concerns\HasRecord;
use Filament\Tables\Filters\Concerns\HasOptions;
use Illuminate\Database\Eloquent\Model;

class BadgeField extends ViewComponent
{
    use HasColor;
    use HasName;
    use HasRecord;
    use CanBeHidden;
    use HasOptions;
    use CanBePill;

    protected string $view = 'filament-badgeable-column::components.badge';

    protected Column $column;

    protected array|Closure $colors = [];

    final public function __construct(string $name)
    {
        $this->name($name);
    }

    public static function make(string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    public function column(Column $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function colors(array|Closure $colors): static
    {
        $this->colors = $colors;

        return $this;
    }

    public function getRecord(): ?Model
    {
        return $this->column->getRecord();
    }

    public function getColor(): ?string
    {
        $record = $this->getRecord();
        $optionColor = null;

        foreach ($this->getColors() as $color => $condition) {
            if (is_numeric($color)) {
                $optionColor = $condition;
            } elseif ($condition instanceof Closure && $condition($record->{$this->name}, $this->getRecord())) {
                $optionColor = $color;
            } elseif ($condition === $record->{$this->name}) {
                $optionColor = $color;
            }
        }

        return $optionColor;
    }

    public function getColors(): array
    {
        return $this->evaluate($this->colors);
    }

    public function getLabel(): string
    {
        return $this->getOptions()[$this->getRecord()->{$this->getName()}];
    }

    protected function getDefaultEvaluationParameters(): array
    {
        return array_merge(parent::getDefaultEvaluationParameters(), [
            'record' => $this->getRecord(),
        ]);
    }
}
