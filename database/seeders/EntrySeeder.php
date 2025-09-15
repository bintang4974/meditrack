<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catSurgical = DB::table('categories')
            ->where('category_main', 'Surgical Care')
            ->where('category_sub', 'Major Surgery')
            ->first();

        DB::table('entries')->insert([
            [
                'project_id' => 1,
                'patient_id' => 1, // Ahmad Fikri (site_id=1)
                'entry_key' => 'ENTRY001',
                'encounter_key' => 'ENC001',
                'category_id' => $catSurgical->id,
                'surgical_date_id' => '2025-09-06',
                'surgical_site_key' => 'RSUD Surabaya',
                'surgery_start_time' => '14:00:00',
                'surgery_end_time' => '15:00:00',
                'operator_1' => 1,
                'operator_2' => 2,
                'preoperative_diagnosis' => 'Lipoma',
                'intraoperative_diagnosis' => 'Benign lipoma',
                'surgical_procedure' => 'Excision of lipoma',
                'estimated_blood_loss' => 50,
                'surgical_notes' => 'Clean excision performed, no complications.',
                'entry_description' => 'Case log for lipoma excision',
                'entry_label' => 'Surgery',
                'entry_date' => '2025-09-06',
                'entry_time' => '14:00:00',
                'log_image_files' => json_encode(['images/lipoma1.jpg']),
                'log_document_files' => json_encode(['docs/lipoma-report.pdf']),
                'entry_supervisor' => 3,
                'competence_level' => 'Beginner',
                'insurance_status' => 'Private',
                'insurance_notes' => 'Partial coverage',
                'created_by' => 2,
                'last_modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
        // [
        //     'project_id' => 1,
        //     'patient_id' => 2,
        //     'category_id' => $catMedical->id,
        //     'entry_key' => 'ENTRY002',
        //     'surgical_date_id' => '2025-09-06',
        //     'surgical_site_key' => 'SITE002',
        //     'surgery_start_time' => '14:00:00',
        //     'surgery_end_time' => '15:00:00',
        //     'operator_1' => 2,
        //     'preoperative_diagnosis' => 'Lipoma',
        //     'intraoperative_diagnosis' => 'Benign lipoma',
        //     'surgical_procedure' => 'Excision of lipoma',
        //     'estimated_blood_loss' => 50,
        //     'surgical_notes' => 'Clean excision performed, no complications.',
        //     'entry_description' => 'Case log for lipoma excision',
        //     'entry_label' => 'Surgery',
        //     'entry_date' => '2025-09-06',
        //     'entry_time' => '14:00:00',
        //     'log_image_files' => json_encode(['images/lipoma1.jpg']),
        //     'log_document_files' => json_encode(['docs/lipoma-report.pdf']),
        //     'entry_supervisor' => 1,
        //     'competence_level' => 'Beginner',
        //     'insurance_status' => 'Private',
        //     'insurance_notes' => 'Partial coverage',
        //     'created_by' => 2,
        //     'last_modified_by' => 1,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]
        // ]);
    }
}
