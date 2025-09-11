<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WaitlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat site
        $siteId = DB::table('sites')->insertGetId([
            'project_id' => 1, // pastikan project_id 1 sudah ada
            'name' => 'RS Siloam Jakarta',
            'location' => 'Jakarta',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Buat pasien
        $patientId = DB::table('patients')->insertGetId([
            'site_id' => $siteId,
            'rekam_medis' => 'RM001',
            'name' => 'Budi Santoso',
            'dob' => '1990-05-15',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Ambil kategori waitlist tracking
        $categoryId = DB::table('categories')
            ->where('category_sub', 'Surgical Waitlist Tracking')
            ->value('id');

        // 4. Buat entry waitlist (status ACTIVE)
        DB::table('entries')->insert([
            'project_id' => 1,
            'patient_id' => $patientId,
            'category_id' => $categoryId,
            'entry_key' => 'ENTRY-WAIT-001',
            'encounter_key' => 'ENC-WAIT-001',
            'waitlist_status' => 'ACTIVE',
            'waitlist_entry_date' => Carbon::now()->subDays(2),
            'waitlist_group' => 'Bedah Umum',
            'waitlist_type' => 'Elektif',
            'waitlist_planned_procedure' => 'Appendectomy',
            'waitlist_operator_key' => null, // bisa isi id dokter
            'created_by' => 1,
            'last_modified_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
