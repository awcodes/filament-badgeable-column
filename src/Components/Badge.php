<?php

namespace Awcodes\Badger\Components;

use Awcodes\Badger\Components\Concerns\CanBePill;
use Awcodes\Badger\Components\Concerns\HasColors;
use Filament\Support\Components\ViewComponent;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\BelongsToTable;
use Filament\Tables\Columns\Concerns\CanBeHidden;
use Filament\Tables\Columns\Concerns\HasLabel;
use Filament\Tables\Columns\Concerns\HasName;
use Filament\Tables\Columns\Concerns\HasRecord;
use Filament\Tables\Columns\Concerns\HasRowLoopObject;
use Filament\Tables\Columns\Concerns\HasState;
use Filament\Tables\Columns\Concerns\HasFontFamily;
use Filament\Tables\Columns\Concerns\HasSize;
use Filament\Tables\Columns\Concerns\HasWeight;
use Illuminate\Database\Eloquent\Model;

class Badge extends ViewComponent
{
    use BelongsToTable;
    use CanBeHidden;
    use CanBePill;
    use HasColors;
    use HasLabel;
    use HasName;
    use HasRecord;
    use HasRowLoopObject;
    use HasState;
    use HasFontFamily;
    use HasSize;
    use HasWeight;

    protected string $view = 'badger::components.badge';

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

    protected function resolveDefaultClosureDependencyForEvaluationByName(string $parameterName): array
    {
        return match ($parameterName) {
            'record' => [$this->getRecord()],
            default => parent::resolveDefaultClosureDependencyForEvaluationByName($parameterName),
        };
    }
}
