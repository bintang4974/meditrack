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
        $ownerId = DB::table('users')->where('email', 'admin@gmail.com')->value('id');

        DB::table('patients')->insert([
            [
                'site_id'            => 1,
                'rekam_medis'        => 'RM001',
                'name'               => 'Ahmad Fikri',
                'dob'                => '1990-05-12',
                'age'                => 34,
                'phone_number'       => '081234567890',
                'address'            => 'Jl. Kenjeran No. 5, Surabaya',
                'working_assessment' => 'Sedang bekerja penuh waktu',
                'context_summary'    => 'Pasien dengan riwayat kanker ovarium, pemeriksaan rutin',
                'diagnosis'          => 'Cancer ovarium',
                'created_by'         => $ownerId,
                'last_modified_by'   => $ownerId,
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ],
            [
                'site_id'            => 2,
                'rekam_medis'        => 'RM002',
                'name'               => 'Dwi Sulistyorini',
                'dob'                => '1985-12-01',
                'age'                => 39,
                'phone_number'       => '082345678901',
                'address'            => 'Jl. Diponegoro No. 12, Surabaya',
                'working_assessment' => 'Ibu rumah tangga',
                'context_summary'    => 'Pasien dengan riwayat kanker ovarium, sudah menjalani operasi',
                'diagnosis'          => 'Cancer ovarium',
                'created_by'         => $ownerId,
                'last_modified_by'   => $ownerId,
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ]
        ]);
    }
}
