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
            ['name' => 'Referral Case', 'description' => 'Encounter originated from an external institution or healthcare provider referral.'],
            ['name' => 'High-Risk Case', 'description' => 'Encounter involving clinically high-risk patients (e.g., advanced disease, severe comorbidities, anesthetic risk).'],
            ['name' => 'VIP Patient Case', 'description' => 'Encounter involving a high-profile or priority patient (e.g., government official, public figure, mandated VIP referral).'],
            ['name' => 'Research Cohort', 'description' => 'Encounter included in a predefined research study, registry, or audit project.'],
            ['name' => 'Government Program', 'description' => 'Encounter linked to a national or regional health program (e.g., cancer screening, maternal health initiative).'],
            ['name' => 'Rare Disease Case', 'description' => 'Encounter involving a rare or uncommon condition with academic or clinical importance.'],
            ['name' => 'Healthcare Worker Case', 'description' => 'Encounter where the patient is a healthcare professional (e.g., physician, nurse, allied health staff).'],
        ];

        foreach ($tags as $tag) {
            Tag::create(array_merge($tag, [
                'created_by' => 1,
                'last_modified_by' => 1,
            ]));
        }

        // Labels contoh
        $labels = [
            ['name' => 'Rare Procedure', 'description' => 'Entry documenting a special or uncommon procedure/activity of high academic or clinical significance.'],
            ['name' => 'Complication Recorded', 'description' => 'Entry where an intra-procedural or post-procedural complication was documented.'],
            ['name' => 'Research Related', 'description' => 'Entry linked to research activity, data collection, or academic publication work.'],
            ['name' => 'Multidisciplinary Involvement', 'description' => 'Entry performed in collaboration with other specialties, units, or departments.'],
            ['name' => 'Teaching Activity', 'description' => 'Entry involving participation in teaching, instruction, or academic demonstration.'],
            ['name' => 'Professional Development', 'description' => 'Entry documenting participation in academic self-development such as symposiums, workshops, seminars, or training courses.'],
        ];

        foreach ($labels as $label) {
            Label::create(array_merge($label, [
                'created_by' => 1,
                'last_modified_by' => 1,
            ]));
        }
    }
}
