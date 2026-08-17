---
title: Installation
description: Install Badgeable Column with Composer and register its views with your Tailwind theme.
---

# Installation

## Requirements

- PHP 8.2 or higher
- Filament 4.x or 5.x

Earlier releases of this package support earlier versions of Filament:

| Package Version | Filament Version |
| --- | --- |
| 1.x | 2.x |
| 2.x | 3.x |
| 3.x | 4.x |
| 4.x | 4.x & 5.x |

## Install the package

Install with Composer:

```bash
composer require awcodes/filament-badgeable-column
```

The service provider is registered automatically, and there is no configuration file to publish.

## Register the views with Tailwind

Badges are rendered from a Blade view in the package, so your Tailwind build has to be able to see that view in order to generate its classes. Add the package as a source in your theme's CSS file:

```css
@source '../../../../vendor/awcodes/filament-badgeable-column/resources/**/*.blade.php';
```

This applies to both the Panels package and the standalone Tables package. If you are using the standalone packages, add the line to your application's CSS file instead of a panel theme.

> [!IMPORTANT]
> Panel users need a custom theme before this line has anywhere to live. If you have not created one yet, follow [Creating a custom theme](https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme) in the Filament documentation first.

The relative path above assumes the conventional theme location, `resources/css/filament/<panel>/theme.css`. Adjust the number of `../` segments if your theme lives elsewhere — the path has to resolve to `vendor/awcodes/filament-badgeable-column/resources` from the file it is written in.

Without this step the badges still render, but with none of their colour, shape, or spacing.

## Next steps

Continue to [Usage](usage.md) to add your first badges.
