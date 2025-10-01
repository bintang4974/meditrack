<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerId = DB::table('users')->where('email', 'admin@gmail.com')->value('id');

        DB::table('sites')->insert([
            [
                'project_id'        => 1,
                'name'              => 'RSUD Surabaya',
                'location'          => 'Jl. Sudirman No. 10, Surabaya',
                'description'       => 'Rumah sakit umum daerah kota Surabaya',
                'institution'       => 'Pemerintah Kota Surabaya',
                'site_type'         => 'hospital',
                'coordinates'       => '-7.2575,112.7521',
                'status'            => 'active',
                'status_updated_at' => Carbon::now(),
                'deactivation_note' => null,
                'created_by'        => $ownerId,
                'last_modified_by'  => $ownerId,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'project_id'        => 1,
                'name'              => 'RS Swandi',
                'location'          => 'Jl. Ahmad Yani No. 25, Surabaya',
                'description'       => 'Rumah sakit swasta di Surabaya',
                'institution'       => 'Yayasan Sehat Abadi',
                'site_type'         => 'hospital',
                'coordinates'       => '-7.2906,112.7271',
                'status'            => 'active',
                'status_updated_at' => Carbon::now(),
                'deactivation_note' => null,
                'created_by'        => $ownerId,
                'last_modified_by'  => $ownerId,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ]);
    }
}
