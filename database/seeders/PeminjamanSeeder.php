<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $arsip = \App\Models\Arsip::pluck('nomor_risalah');
        $users = \App\Models\User::pluck('id');

        // Insert sample rows with varied statuses
        for ($i = 0; $i < 20; $i++) {
            $status = $faker->randomElement(['pending', 'approved', 'returned']);
            $borrowedDate = now()->subDays(rand(1, 30));

            // Set returned date only if status is 'returned'
            $returnedDate = null;
            if ($status === 'returned') {
                $returnedDate = $borrowedDate->copy()->addDays(rand(1, 14))->toDateString();
            }

            Peminjaman::create([
                'arsip_id' => $arsip->random(),
                'user_id' => $users->random(),
                'borrowed' => $borrowedDate->toDateString(),
                'returned' => $returnedDate,
                'status' => $status,
            ]);
        }
    }
}
