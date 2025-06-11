<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Components;

use Awcodes\BadgeableColumn\Concerns\HasBadges;
use Filament\Infolists\Components\TextEntry;

class BadgeableEntry extends TextEntry
{
    use HasBadges;
}
