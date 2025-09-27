<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();

        $sites = Site::whereIn('name', ['RSUD Surabaya', 'RS Swandi'])->get();

        if ($sites->count() < 2) {
            $this->command->warn("Seeder butuh minimal 2 site: RSUD Surabaya dan RS Swandi. Pastikan sudah ada di DB.");
            return;
        }

        $rsud = $sites->firstWhere('name', 'RSUD Surabaya');
        $swandi = $sites->firstWhere('name', 'RS Swandi');

        foreach ($doctors as $index => $doctor) {
            if ($index % 2 == 0) {
                // Assign ke RSUD Surabaya
                $doctor->sites()->syncWithoutDetaching([$rsud->id]);
            } else {
                // Assign ke RS Swandi
                $doctor->sites()->syncWithoutDetaching([$swandi->id]);
            }

            // Tambahan: setiap kelipatan 5 → assign ke 2 site
            if ($index % 5 == 0) {
                $doctor->sites()->syncWithoutDetaching([$swandi->id]);
            }
        }

        $this->command->info("Doctor-Site seeding selesai ✅");
    }
}
