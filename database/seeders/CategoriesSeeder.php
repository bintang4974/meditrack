<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Surgical Care" => [
                "Major Surgery",
                "Minor Surgery",
                "Minimally Invasive Surgery",
                "Other Surgical Procedures",
            ],
            "Medical Care" => [
                "Pharmacological Therapy",
                "Rehabilitation Therapy",
                "Nutritional Therapy",
                "Systemic Cancer Treatment",
                "Nuclear Medicine Therapy",
                "Pain Management",
                "Medical Acupuncture",
                "Counseling & Education",
                "Other Medical Services",
            ],
            "Clinical Diagnostics" => [
                "Imaging Studies",
                "Hematology Testing",
                "Anatomical Pathology",
                "Molecular Diagnostics",
                "Biochemistry & Immunology",
                "Microbiological Testing",
                "Parasitology Testing",
                "Nuclear Medicine Imaging",
                "Forensic Diagnostics",
                "Other Diagnostic Procedures",
            ],
            "Academic Activity" => [
                "Teaching & Supervision",
                "Scientific Presentation",
                "Academic Assignments",
                "Publication Work",
                "Academic Administrative Task",
                "Other Academic Activity",
            ],
            "Community Service" => [
                "Health Education Campaign",
                "Community Screening",
                "Mobile Clinic Services",
                "Public Health Collaboration",
                "Health Advocacy",
                "Other Community Service",
            ],
            "Clinical Assessment" => [
                "Mini-CEX",
                "DOPS",
                "CBD",
                "OSCE",
                "COT",
                "Log Verification",
                "Other Assessment",
            ],
            "Other Activities" => [
                "Surgical Waitlist Tracking",
                "Surgical Report",
                "Intraoperative Photographic Documentation",
                "Simulation-Based Training",
                "Interdisciplinary Meeting",
                "Institutional Visit",
                "Curriculum Workshop",
                "Portfolio Review",
                "System Improvement Activity",
                "Other Loggable Activity",
            ],
        ];

        foreach ($categories as $main => $subs) {
            $categoryId = DB::table('categories')->insertGetId([
                'project_id' => 1, // default project
                'name' => $main,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            foreach ($subs as $sub) {
                DB::table('sub_categories')->insert([
                    'category_id' => $categoryId,
                    'name' => $sub,
                    'is_active' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
