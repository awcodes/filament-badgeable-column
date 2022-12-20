<?php

namespace Awcodes\FilamentBadgeableColumn\Components;

use Awcodes\FilamentBadgeableColumn\Components\Concerns\CanBePill;
use Awcodes\FilamentBadgeableColumn\Components\Concerns\HasColor;
use Filament\Support\Components\ViewComponent;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanBeHidden;
use Filament\Tables\Columns\Concerns\HasLabel;
use Filament\Tables\Columns\Concerns\HasName;
use Filament\Tables\Columns\Concerns\HasRecord;
use Illuminate\Database\Eloquent\Model;

class Badge extends ViewComponent
{
    use HasColor;
    use HasLabel;
    use HasName;
    use HasRecord;
    use CanBeHidden;
    use CanBePill;

    protected string $view = 'filament-badgeable-column::components.badge';

    protected Column $column;

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

    public function getRecord(): ?Model
    {
        return $this->column->getRecord();
    }

    protected function getDefaultEvaluationParameters(): array
    {
        return array_merge(parent::getDefaultEvaluationParameters(), [
            'record' => $this->getRecord(),
        ]);
    }
}
