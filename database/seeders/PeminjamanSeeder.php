<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arsip = \App\Models\Arsip::pluck('id');
        $users = \App\Models\User::pluck('id');

        // Insert 5 sample rows
        for ($i = 0; $i < 5; $i++) {
            Peminjaman::create([
                'arsip_id' => $arsip->random(),
                'user_id' => $users->random(),
                'borrowed' => now()->subDays(rand(1, 10))->toDateString(),
                'returned' => null,
                'status' => 'pending',
            ]);
        }
    }
}
