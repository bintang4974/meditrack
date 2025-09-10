<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            [
                'site_id' => 1,
                'name' => 'Dr. Andi Specialist',
                'specialization' => 'General Surgery',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'site_id' => 1,
                'name' => 'Dr. Budi Specialist',
                'specialization' => 'Orthopedics',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'site_id' => 2,
                'name' => 'Dr. Clara Specialist',
                'specialization' => 'Obstetrics & Gynecology',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
