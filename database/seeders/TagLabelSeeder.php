<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tags contoh
        $tags = [
            ['name' => 'Referral Case', 'description' => 'Encounter originated from referral'],
            ['name' => 'High-Risk Case', 'description' => 'Clinically high-risk patient'],
            ['name' => 'VIP Patient Case', 'description' => 'Government official or priority patient'],
        ];

        foreach ($tags as $tag) {
            Tag::create(array_merge($tag, [
                'created_by' => 1,
                'last_modified_by' => 1,
            ]));
        }

        // Labels contoh
        $labels = [
            ['name' => 'Rare Procedure', 'description' => 'Special or uncommon procedure'],
            ['name' => 'Complication Recorded', 'description' => 'Intra or post-op complication'],
            ['name' => 'Research Related', 'description' => 'Linked to research activity'],
        ];

        foreach ($labels as $label) {
            Label::create(array_merge($label, [
                'created_by' => 1,
                'last_modified_by' => 1,
            ]));
        }
    }
}
