<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@akademik.com',
            'password' => Hash::make('password'),
        ]);

        // Jurusan
        $jurusan = [
            ['nama_jurusan' => 'Teknik Informatika',       'akreditasi' => 'A'],
            ['nama_jurusan' => 'Sistem Informasi',         'akreditasi' => 'A'],
            ['nama_jurusan' => 'Teknik Elektro',           'akreditasi' => 'B'],
            ['nama_jurusan' => 'Teknik Sipil',             'akreditasi' => 'B'],
            ['nama_jurusan' => 'Manajemen Informatika',    'akreditasi' => 'C'],
        ];

        foreach ($jurusan as $j) {
            Jurusan::create($j);
        }

        // Mahasiswa
        $mahasiswaData = [
            ['nim' => '2024001', 'nama' => 'Andi Pratama',       'id_jurusan' => 1],
            ['nim' => '2024002', 'nama' => 'Budi Santoso',       'id_jurusan' => 1],
            ['nim' => '2024003', 'nama' => 'Citra Dewi',         'id_jurusan' => 2],
            ['nim' => '2024004', 'nama' => 'Dian Permata',       'id_jurusan' => 2],
            ['nim' => '2024005', 'nama' => 'Eko Wahyudi',        'id_jurusan' => 3],
            ['nim' => '2024006', 'nama' => 'Fitri Handayani',    'id_jurusan' => 3],
            ['nim' => '2024007', 'nama' => 'Galuh Purnama',      'id_jurusan' => 4],
            ['nim' => '2024008', 'nama' => 'Hendra Gunawan',     'id_jurusan' => 1],
            ['nim' => '2024009', 'nama' => 'Indah Lestari',      'id_jurusan' => 2],
            ['nim' => '2024010', 'nama' => 'Joko Widodo',        'id_jurusan' => 5],
        ];

        foreach ($mahasiswaData as $m) {
            Mahasiswa::create($m);
        }

        // Matakuliah
        $matakuliahData = [
            ['nama_matakuliah' => 'Algoritma & Pemrograman',    'sks' => 3, 'id_jurusan' => 1],
            ['nama_matakuliah' => 'Basis Data',                 'sks' => 3, 'id_jurusan' => 1],
            ['nama_matakuliah' => 'Pemrograman Web',            'sks' => 3, 'id_jurusan' => 1],
            ['nama_matakuliah' => 'Kecerdasan Buatan',          'sks' => 3, 'id_jurusan' => 1],
            ['nama_matakuliah' => 'Analisis Sistem Informasi',  'sks' => 3, 'id_jurusan' => 2],
            ['nama_matakuliah' => 'Manajemen Proyek IT',        'sks' => 2, 'id_jurusan' => 2],
            ['nama_matakuliah' => 'Rangkaian Listrik',          'sks' => 3, 'id_jurusan' => 3],
            ['nama_matakuliah' => 'Elektronika Dasar',          'sks' => 3, 'id_jurusan' => 3],
            ['nama_matakuliah' => 'Mekanika Tanah',             'sks' => 3, 'id_jurusan' => 4],
            ['nama_matakuliah' => 'Pemrograman Aplikasi',       'sks' => 3, 'id_jurusan' => 5],
        ];

        foreach ($matakuliahData as $mk) {
            Matakuliah::create($mk);
        }
    }
}
