<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Concerns;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

trait HasBadges
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

    public function getBadges(array|Closure $badges): string
    {
        $badges = $this->evaluate($badges);
        $badgesHtml = '';

        foreach ($badges as $badge) {
            $badgeHtml = $badge
                ->column($this)
                ->isPill($this->shouldBePills())
                ->render();

            $badgesHtml .= Str::of($badgeHtml)
                ->replace('<!-- __BLOCK__ --> ', '')
                ->replace('<!-- __ENDBLOCK__ -->', '')
                ->replace('<!--[if BLOCK]><![endif]-->', '')
                ->replace('<!--[if ENDBLOCK]><![endif]-->', '')
                ->replace('/n', '')
                ->trim();
        }

        return $badgesHtml;
    }

    public function getPrefix(): string|Htmlable|null
    {
        $badges = $this->getPrefixBadges();

        if ($badges) {
            return new HtmlString('<span style="display:inline-flex;gap:0.375rem;margin-inline-end:0.25rem;">'.$badges.'</span><span style="opacity: 0.375;">'.$this->getSeparator().'</span> '.parent::getPrefix());
        }

        return parent::getPrefix();
    }

    public function getPrefixBadges(): string
    {
        return $this->getBadges($this->prefixBadges);
    }

    public function getSuffix(): string|Htmlable|null
    {
        $badges = $this->getSuffixBadges();

        if ($badges) {
            return new HtmlString(parent::getSuffix().' <span style="opacity: 0.375;">'.$this->getSeparator().'</span><span style="display:inline-flex;gap:0.375rem;margin-inline-start:0.25rem;">'.$badges.'</span>');
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
        return (bool) $this->evaluate($this->asPills);
    }

    public function suffixBadges(array|Closure $badges): static
    {
        $this->suffixBadges = $badges;

        return $this;
    }

    public function getSeparator(): ?string
    {
        return $this->evaluate($this->separator) ?? '&mdash;';
    }
}
