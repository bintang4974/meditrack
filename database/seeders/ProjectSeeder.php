<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Entry;
use App\Models\Patient;
use App\Models\Project;
use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'site_id' => 1,
                'name' => 'Project RSUD Surabaya',
                'description' => 'Logbook project untuk RSUD Surabaya',
                'voucher_code' => 'PRJAAA0001',
                'owner_id' => 1, // user Admin
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
