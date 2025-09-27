<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patients')->insert([
            [
                'site_id' => 1,
                'rekam_medis' => 'RM001',
                'name' => 'Ahmad Fikri',
                'dob' => '1990-05-12',
                'diagnosis' => 'cancer ovarium',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'site_id' => 2,
                'rekam_medis' => 'RM002',
                'name' => 'Dwi Sulistyorini',
                'dob' => '1985-12-01',
                'diagnosis' => 'cancer ovarium',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
