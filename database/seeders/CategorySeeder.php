<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Get all teams
        $teams = Team::all();

        if ($teams->isEmpty()) {
            $this->command->warn('No teams found. Creating default team...');
            $team = Team::create([
                'name' => 'Default Team',
                'slug' => 'default-team',
            ]);
            $teams = collect([$team]);
        }

        // Define default post categories
        $defaultCategories = [
            'Infografis',
            'Artikel',
            'Pengumuman',
            'Berita'
        ];

        // Create categories for each team
        foreach ($teams as $team) {
            foreach ($defaultCategories as $categoryName) {
                // Use firstOrCreate to prevent duplicates
                Category::firstOrCreate(
                    [
                        'team_id' => $team->id,
                        'name' => $categoryName,
                    ],
                    [
                        'slug' => Str::slug($categoryName),
                    ]
                );
            }
        }
    }
}
