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
                'project_key' => 'PRJAAA0001',
                'encounter_key' => 'ENC001',
                'category_id' => 1, // Surgical Care - Major Surgery
                'entry_key' => 'ENTRY001',
                'surgical_date_id' => '2025-09-05',
                'surgical_site_key' => 'SITE001',
                'surgery_start_time' => '10:00:00',
                'surgery_end_time' => '11:30:00',
                'operator_1' => 1,
                'operator_2' => 2,
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
            ]
        ]);
    }
}
