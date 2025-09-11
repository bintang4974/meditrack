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
        DB::table('entries')->insert([
            [
                'project_id' => 1,
                'encounter_key' => 'ENC001',
                'category_id' => 1,
                'entry_key' => 'ENTRY001',
                'surgical_date_id' => '2025-09-05',
                'surgical_site_key' => 'SITE001',
                'surgery_start_time' => '10:00:00',
                'surgery_end_time' => '11:30:00',
                'operator_1' => 1,
                'operator_2' => 2,
                'operator_3' => null,
                'operator_4' => null,
                'preoperative_diagnosis' => 'Acute appendicitis',
                'intraoperative_diagnosis' => 'Perforated appendix',
                'surgical_procedure' => 'Appendectomy',
                'estimated_blood_loss' => 150,
                'surgical_notes' => 'Procedure successful with minor complications.',
                'entry_description' => 'Case log for appendectomy',
                'entry_label' => 'Surgery',
                'entry_date' => '2025-09-05',
                'entry_time' => '10:00:00',
                'log_image_files' => json_encode(['images/appendix1.jpg', 'images/appendix2.jpg']),
                'log_document_files' => json_encode(['docs/appendix-report.pdf']),
                'entry_supervisor' => 3,
                'competence_level' => 'Intermediate',
                'insurance_status' => 'BPJS',
                'insurance_notes' => 'Covered fully',
                'created_by' => 3,
                'last_modified_by' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 1,
                'encounter_key' => 'ENC002',
                'category_id' => 2,
                'entry_key' => 'ENTRY002',
                'surgical_date_id' => '2025-09-06',
                'surgical_site_key' => 'SITE002',
                'surgery_start_time' => '14:00:00',
                'surgery_end_time' => '15:00:00',
                'operator_1' => 2,
                'operator_2' => null, // ✅ ditambah biar kolom sama
                'operator_3' => null,
                'operator_4' => null,
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
                'entry_supervisor' => 1,
                'competence_level' => 'Beginner',
                'insurance_status' => 'Private',
                'insurance_notes' => 'Partial coverage',
                'created_by' => 2,
                'last_modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
