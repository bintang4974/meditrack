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
            // Surgical Care
            ['key' => 'CAT1001', 'main' => 'Surgical Care', 'sub' => 'Major Surgery'],
            ['key' => 'CAT1002', 'main' => 'Surgical Care', 'sub' => 'Minor Surgery'],
            ['key' => 'CAT1003', 'main' => 'Surgical Care', 'sub' => 'Minimally Invasive Surgery'],
            ['key' => 'CAT1007', 'main' => 'Surgical Care', 'sub' => 'Other Surgical Procedures'],

            // Medical Care
            ['key' => 'CAT2001', 'main' => 'Medical Care', 'sub' => 'Pharmacological Therapy'],
            ['key' => 'CAT2002', 'main' => 'Medical Care', 'sub' => 'Rehabilitation Therapy'],
            ['key' => 'CAT2003', 'main' => 'Medical Care', 'sub' => 'Nutritional Therapy'],
            ['key' => 'CAT2004', 'main' => 'Medical Care', 'sub' => 'Systemic Anticancer Therapy'],
            ['key' => 'CAT2005', 'main' => 'Medical Care', 'sub' => 'Nuclear Medicine Therapy'],
            ['key' => 'CAT2006', 'main' => 'Medical Care', 'sub' => 'Pain Management'],
            ['key' => 'CAT2007', 'main' => 'Medical Care', 'sub' => 'Medical Acupuncture'],
            ['key' => 'CAT2008', 'main' => 'Medical Care', 'sub' => 'Counseling & Education'],
            ['key' => 'CAT2009', 'main' => 'Medical Care', 'sub' => 'Other Medical Services'],

            // Clinical Diagnostics
            ['key' => 'CAT3001', 'main' => 'Clinical Diagnostics', 'sub' => 'Imaging Studies'],
            ['key' => 'CAT3002', 'main' => 'Clinical Diagnostics', 'sub' => 'Hematology Testing'],
            ['key' => 'CAT3003', 'main' => 'Clinical Diagnostics', 'sub' => 'Anatomical Pathology'],
            ['key' => 'CAT3004', 'main' => 'Clinical Diagnostics', 'sub' => 'Molecular Diagnostics'],
            ['key' => 'CAT3005', 'main' => 'Clinical Diagnostics', 'sub' => 'Biochemistry & Immunology'],
            ['key' => 'CAT3006', 'main' => 'Clinical Diagnostics', 'sub' => 'Microbiological Testing'],
            ['key' => 'CAT3007', 'main' => 'Clinical Diagnostics', 'sub' => 'Parasitology Testing'],
            ['key' => 'CAT3008', 'main' => 'Clinical Diagnostics', 'sub' => 'Nuclear Medicine Imaging'],
            ['key' => 'CAT3009', 'main' => 'Clinical Diagnostics', 'sub' => 'Forensic Diagnostics'],
            ['key' => 'CAT3010', 'main' => 'Clinical Diagnostics', 'sub' => 'Other Diagnostic Procedures'],

            // Academic Activity
            ['key' => 'CAT4001', 'main' => 'Academic Activity', 'sub' => 'Teaching & Supervision'],
            ['key' => 'CAT4002', 'main' => 'Academic Activity', 'sub' => 'Scientific Presentation'],
            ['key' => 'CAT4003', 'main' => 'Academic Activity', 'sub' => 'Academic Assignments'],
            ['key' => 'CAT4004', 'main' => 'Academic Activity', 'sub' => 'Publication Work'],
            ['key' => 'CAT4005', 'main' => 'Academic Activity', 'sub' => 'Academic Administrative Task'],
            ['key' => 'CAT4006', 'main' => 'Academic Activity', 'sub' => 'Other Academic Activity'],

            // Community Service
            ['key' => 'CAT5001', 'main' => 'Community Service', 'sub' => 'Health Education Campaign'],
            ['key' => 'CAT5002', 'main' => 'Community Service', 'sub' => 'Community Screening'],
            ['key' => 'CAT5003', 'main' => 'Community Service', 'sub' => 'Mobile Clinic Services'],
            ['key' => 'CAT5004', 'main' => 'Community Service', 'sub' => 'Public Health Collaboration'],
            ['key' => 'CAT5005', 'main' => 'Community Service', 'sub' => 'Health Advocacy'],
            ['key' => 'CAT5006', 'main' => 'Community Service', 'sub' => 'Other Community Service'],

            // Clinical Assessment
            ['key' => 'CAT6001', 'main' => 'Clinical Assessment', 'sub' => 'Mini-CEX'],
            ['key' => 'CAT6002', 'main' => 'Clinical Assessment', 'sub' => 'DOPS'],
            ['key' => 'CAT6003', 'main' => 'Clinical Assessment', 'sub' => 'CBD'],
            ['key' => 'CAT6004', 'main' => 'Clinical Assessment', 'sub' => 'OSCE'],
            ['key' => 'CAT6005', 'main' => 'Clinical Assessment', 'sub' => 'COT'],
            ['key' => 'CAT6006', 'main' => 'Clinical Assessment', 'sub' => 'Log Verification'],
            ['key' => 'CAT6007', 'main' => 'Clinical Assessment', 'sub' => 'Other Assessment'],

            // Other Activities
            ['key' => 'CAT7001', 'main' => 'Other Activities', 'sub' => 'Surgical Waitlist Tracking'],
            ['key' => 'CAT7002', 'main' => 'Other Activities', 'sub' => 'Surgical Report'],
            ['key' => 'CAT7003', 'main' => 'Other Activities', 'sub' => 'Intraoperative Photographic Documentation'],
            ['key' => 'CAT7004', 'main' => 'Other Activities', 'sub' => 'Simulation-Based Training'],
            ['key' => 'CAT7005', 'main' => 'Other Activities', 'sub' => 'Interdisciplinary Meeting'],
            ['key' => 'CAT7006', 'main' => 'Other Activities', 'sub' => 'Institutional Visit'],
            ['key' => 'CAT7007', 'main' => 'Other Activities', 'sub' => 'Curriculum Workshop'],
            ['key' => 'CAT7008', 'main' => 'Other Activities', 'sub' => 'Portfolio Review'],
            ['key' => 'CAT7009', 'main' => 'Other Activities', 'sub' => 'System Improvement Activity'],
            ['key' => 'CAT7010', 'main' => 'Other Activities', 'sub' => 'Other Loggable Activity'],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'project_key' => 'PRJAAA0001',
                'category_key' => 'PRJAAA0001-' . $cat['key'],
                'category_main' => $cat['main'],
                'category_sub' => $cat['sub'],
                'category_is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
