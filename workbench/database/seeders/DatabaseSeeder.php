<?php

declare(strict_types=1);

namespace Workbench\Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Workbench\Database\Factories\PostFactory;
use Workbench\Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserFactory::new()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Fixed posts at fixed dates, so documentation screenshots are the same on every build. They cover every
        // badge state: each category, published and draft, and one post with no category badge at all.
        $posts = [
            ['Introducing badgeable columns', 'Announcements', true],
            ['Adding badges to an infolist entry', 'Guides', true],
            ['Version 4.1 release notes', 'Release Notes', true],
            ['Styling badges with colours and shapes', 'Guides', false],
            ['Choosing a separator between badges and text', null, true],
            ['Roadmap for the next major version', 'Announcements', false],
        ];

        foreach ($posts as $index => [$title, $category, $published]) {
            $date = CarbonImmutable::parse('2026-01-01 09:00:00')->addDays($index);

            PostFactory::new()->create([
                'title' => $title,
                'content' => "{$title}: a short summary of what this post covers, written as a fixed fixture so the Workbench always renders the same text.",
                'category' => $category,
                'is_published' => $published,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
