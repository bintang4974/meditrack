<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminId     = DB::table('users')->where('email', 'admin@gmail.com')->value('id');
        $doctorId    = DB::table('users')->where('email', 'birama@gmail.com')->value('id');
        $doctorId2  = DB::table('users')->where('email', 'naufal@gmail.com')->value('id');

        if (!$adminId || !$doctorId) {
            throw new \Exception("UserSeeder belum jalan atau email user tidak ditemukan.");
        }

        DB::table('user_projects')->insert([
            [
                'user_id' => $adminId,
                'project_id' => 1,
                'role_in_project' => 'owner',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $doctorId,
                'project_id' => 1,
                'role_in_project' => 'member',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $doctorId2,
                'project_id' => 1,
                'role_in_project' => 'member',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
