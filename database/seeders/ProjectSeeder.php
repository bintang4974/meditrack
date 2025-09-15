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
        $ownerId = DB::table('users')->where('email', 'admin@gmail.com')->value('id');

        if (!$ownerId) {
            throw new \Exception("User admin@gmail.com belum ada, jalankan UserSeeder dulu!");
        }

        DB::table('projects')->insert([
            [
                'project_code' => 'PRJAAA0001',
                'voucher_code' => Str::upper(Str::random(8)),
                'name' => 'Project Operasi Obgyn Jawa Timur',
                'description' => 'Logbook project untuk berbagai RS di Jawa Timur',
                'owner_id' => $ownerId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
