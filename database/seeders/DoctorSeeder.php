<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            ['name' => 'MUHAMMAD DIKMAN ANGSAR', 'role' => 'supervisor'],
            ['name' => 'LILA DEWATA AZINAR', 'role' => 'supervisor'],
            ['name' => 'SAMSULHADI', 'role' => 'supervisor'],
            ['name' => 'SOEHARTONO DARMOSOEKARTO', 'role' => 'supervisor'],
            ['name' => 'ERRY GUMILAR DACHLAN', 'role' => 'supervisor'],
            ['name' => 'POEDJO HARTONO', 'role' => 'supervisor'],
            ['name' => 'HARI PARATON', 'role' => 'supervisor'],
            ['name' => 'HERMANTO TRI JOEWONO', 'role' => 'supervisor'],
            ['name' => 'HENDY HENDARTO', 'role' => 'supervisor'],
            ['name' => 'AGUS SULISTYONO', 'role' => 'supervisor'],
            ['name' => 'BUDI SANTOSO', 'role' => 'supervisor'],
            ['name' => 'WITA SARASWATI', 'role' => 'supervisor'],
            ['name' => 'BRAHMANA ASKANDAR TJOKROPRAWIRO', 'role' => 'supervisor'],
            ['name' => 'SRI RATNA DWININGSIH', 'role' => 'supervisor'],
            ['name' => 'BAKSONO WINARDI', 'role' => 'supervisor'],
            ['name' => 'RELLY YANUARI PRIMARIAWAN', 'role' => 'supervisor'],
            ['name' => 'ASHON SA\'ADI', 'role' => 'supervisor'],
            ['name' => 'BUDI PRASETYO', 'role' => 'supervisor'],
            ['name' => 'INDRA YULIATI', 'role' => 'supervisor'],
            ['name' => 'GATUT HARDIANTO', 'role' => 'supervisor'],
            ['name' => 'EIGHTY MARDIYAN KURNIAWATI', 'role' => 'supervisor'],
            ['name' => 'JIMMY YANUAR ANNAS', 'role' => 'supervisor'],
            ['name' => 'ERNAWATI', 'role' => 'supervisor'],
            ['name' => 'MUHAMMAD ARDIAN CAHYA LAKSANA', 'role' => 'supervisor'],
            ['name' => 'MUHAMMAD ILHAM ALDIKA AKBAR', 'role' => 'supervisor'],
            ['name' => 'PUNGKY MULAWRDHANA', 'role' => 'doctor'],
            ['name' => 'PRIMANDONO PERBOWO', 'role' => 'supervisor'],
            ['name' => 'BUDI WICAKSONO', 'role' => 'supervisor'],
            ['name' => 'HARI NUGROHO', 'role' => 'supervisor'],
            ['name' => 'MUHAMMAD YUSUF', 'role' => 'supervisor'],
            ['name' => 'M Y ARDIANTA WIDYANUGRAHA', 'role' => 'supervisor'],
            ['name' => 'MANGGALA PASCA WARDHANA', 'role' => 'supervisor'],
            ['name' => 'KHANISYAH ERZA GUMILAR', 'role' => 'supervisor'],
            ['name' => 'HANIFA ERLIN DHARMAYANTI', 'role' => 'supervisor'],
            ['name' => 'RIZKI PRANADYAN', 'role' => 'supervisor'],
            ['name' => 'ARIF TUNJUNGSETO', 'role' => 'supervisor'],
            ['name' => 'NARES WARI IMANADHA CININTA M', 'role' => 'supervisor'],
            ['name' => 'ROZI ADITYA ARYANANDA', 'role' => 'supervisor'],
            ['name' => 'BIRAMA ROBBY INDRAPRASTA', 'role' => 'supervisor'],
            ['name' => 'TRI HASTONO SETYO HADI', 'role' => 'supervisor'],
            ['name' => 'PANDU HANINDITO HABIBIE', 'role' => 'supervisor'],
            ['name' => 'SOEDARSONO HADIPRANATA', 'role' => 'doctor'],
            ['name' => 'MUHAMMAD DIMAS ABDI PUTRA', 'role' => 'supervisor'],
            ['name' => 'ECCITA RAHESTYNINGTYAS', 'role' => 'supervisor'],
            ['name' => 'KHOIRUNNISA NOVITASARI', 'role' => 'supervisor'],
            ['name' => 'BAYU PRIANGGA', 'role' => 'supervisor'],
            ['name' => 'RISKA WAHYUNINGTYAS', 'role' => 'supervisor'],
            ['name' => 'QURRATA AKYUNI', 'role' => 'supervisor'],
        ];

        foreach ($doctors as $doc) {
            $email = Str::of($doc['name'])
                ->lower()
                ->replace("'", '') // hapus tanda petik
                ->replace('.', '') // hilangkan titik
                ->replace(',', '') // hilangkan koma
                ->replace('-', '') // hilangkan strip
                ->replace('  ', ' ') // double space jadi single
                ->replace(' ', '.') // ganti space jadi titik
                . '@meditrack.test';

            Doctor::create([
                'name' => $doc['name'],
                'email' => $email,
                'role' => $doc['role'],
                'status' => 'active',
                'status_updated_at' => Carbon::now(),
                'created_by' => 1, // admin id
                'last_modified_by' => 1,
            ]);
        }
    }
}
