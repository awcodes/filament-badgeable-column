<?php

namespace Awcodes\Badger\Components;

use Closure;
use Filament\Tables\Columns\TextColumn;

class BadgerColumn extends TextColumn
{
    protected array|Closure $prefixBadges = [];

    protected array|Closure $suffixBadges = [];

    protected bool|Closure $asPills = false;

    protected function setUp(): void
    {
        $this->html();
    }

    public function asPills(bool|Closure $condition = true): static
    {
        $this->asPills = $condition;

        return $this;
    }

    public function getBadges(array $badges): string
    {
        // only evaluate the badges at the point of retrieval, to ensure the rest of the livewire component stack + needed data is available.
        $badges = $this->evaluate($badges);
        $badgesHtml = '';

        foreach ($badges as $k => $badge) {
            $badgesHtml .= $badge
                ->column($this)
                ->isPill($this->shouldBePills())
                ->render();
        }

        return $badgesHtml;
    }

    public function getPrefix(): ?string
    {
        $badges = $this->getPrefixBadges();

        if ($badges) {
            return  $badges . ' <span style="opacity: 0.375;">&mdash;</span> ' .  parent::getPrefix();
        }

        return parent::getPrefix();
    }

    public function getPrefixBadges(): string
    {
        return $this->getBadges($this->prefixBadges);
    }

    public function getSuffix(): ?string
    {
        $badges = $this->getSuffixBadges();

        if ($badges) {
            return parent::getSuffix() . ' <span style="opacity: 0.375;">&mdash;</span> ' . $badges;
        }

        return parent::getSuffix();
    }

    public function getSuffixBadges(): string
    {
        return $this->getBadges($this->suffixBadges);
    }

    public function prefixBadges(array|Closure $badges): static
    {
        $this->prefixBadges = $badges;

        return $this;
    }

    public function shouldBePills(): bool
    {
        return $this->evaluate($this->asPills);
    }

    public function suffixBadges(array|Closure $badges): static
    {
        $this->suffixBadges = $badges;

        return $this;
    }
}
