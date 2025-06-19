<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Shield seeder untuk permission
            ShieldSeeder::class,
            // Team harus dibuat sebelum user-team assignment
            TeamSeeder::class,
            // User seeder karena dibutuhkan oleh seeders lain
            UserSeeder::class,
            // Seeders untuk konten
            PengaturanSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            PostCategorySeeder::class,
        ]);
    }
}
