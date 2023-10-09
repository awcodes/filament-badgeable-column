<?php

namespace Awcodes\FilamentBadgeableColumn\Components;

use Awcodes\FilamentBadgeableColumn\Concerns\HasBadges;
use Filament\Infolists\Components\TextEntry;

class BadgeableEntry extends TextEntry
{
    use HasBadges;
}
