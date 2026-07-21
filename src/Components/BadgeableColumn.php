<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Components;

use Awcodes\BadgeableColumn\Concerns\HasBadges;
use Filament\Tables\Columns\TextColumn;

class BadgeableColumn extends TextColumn
{
    use HasBadges;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formatStateUsing(static fn (mixed $state): mixed => $state);
    }
}
