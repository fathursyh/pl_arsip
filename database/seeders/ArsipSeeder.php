<?php

namespace Database\Seeders;

use App\Models\Arsip;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArsipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            Arsip::create([
                'nomor_risalah' => 'RSL/' . date('Y') . '/' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'pemohon' => $faker->name(),
                'jenis_lelang' => $faker->randomElement(['jenis1', 'jenis2']),
                'uraian_barang' => $faker->paragraph(3),
                'status' => $faker->boolean(80), // 80% chance of true
            ]);
        }
    }
}
