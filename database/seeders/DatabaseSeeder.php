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
            'email' => 'root@admin.com',
            'role' => RoleEnum::ADMIN,
        ]);
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@admin.com',
            'role' => RoleEnum::USER,
        ]);
          $this->call([
            ArsipSeeder::class,
            PeminjamanSeeder::class,
        ]);
    }
}
