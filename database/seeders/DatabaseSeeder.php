<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'root',
            'nip' => '123',
            'role' => RoleEnum::ADMIN,
        ]);
        User::factory()->create([
            'name' => 'Laili Athiyyah',
            'nip' => '321',
            'role' => RoleEnum::USER,
        ]);
          $this->call([
            ArsipSeeder::class,
            PeminjamanSeeder::class,
        ]);
    }
}
