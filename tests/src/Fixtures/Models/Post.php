<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Tests\Fixtures\Models;

use Awcodes\BadgeableColumn\Tests\Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected $guarded = [];

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }
}
