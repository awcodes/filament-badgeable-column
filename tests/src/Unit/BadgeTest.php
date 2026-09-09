<?php

declare(strict_types=1);

use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Tests\TestCase;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\Size;

uses(TestCase::class);

beforeEach(function () {
    $this->component = (new Badge('test'));
});

it('has correct color', function (string | array | Closure $color) {
    $this->component->color($color);

    expect($this->component)
        ->getColor()->toBe($color);
})->with([
    Color::Pink['500'],
    '#badA55',
    'danger',
    fn () => Color::Slate['500'],
]);

it('has correct size', function (string | Closure | Size $size) {
    $this->component->size($size);

    expect($this->component)
        ->getSize()->toBeInstanceOf(Size::class);

    if ($size instanceof Size) {
        expect($this->component->getSize())->toBe($size);
    } else {
        expect($this->component->getSize()->value)->toBe($size);
    }
})->with([
    'md',
    fn () => 'lg',
    Size::ExtraLarge,
]);

it('has correct font family', function (string | Closure | FontFamily $family) {
    $this->component->fontFamily($family);

    expect($this->component)
        ->getFontFamily()->toBeInstanceOf(FontFamily::class);

    if ($family instanceof FontFamily) {
        expect($this->component->getFontFamily())->toBe($family);
    } else {
        expect($this->component->getFontFamily()->value)->toBe($family);
    }
})->with([
    'serif',
    fn () => 'sans',
    FontFamily::Mono,
]);

it('has correct font weight', function (string | Closure | FontWeight $family) {
    $this->component->weight($family);

    expect($this->component)
        ->getWeight()->toBeInstanceOf(FontWeight::class);

    if ($family instanceof FontWeight) {
        expect($this->component->getWeight())->toBe($family);
    } else {
        expect($this->component->getWeight()->value)->toBe($family);
    }
})->with([
    'bold',
    fn () => 'medium',
    FontWeight::Black,
]);
