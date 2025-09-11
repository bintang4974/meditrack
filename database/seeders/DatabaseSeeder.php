<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SiteSeeder::class,
            ProjectSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            EncounterSeeder::class,
            CategoriesSeeder::class,
            UserProjectSeeder::class,
            EntrySeeder::class,
        ]);

        // $this->call(ProjectSeeder::class);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
