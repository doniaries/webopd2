<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to avoid constraint issues
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Tag::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Get all teams
        $teams = Team::all();

        // Common tags that will be created for each team
        $tags = [
            'Teknologi',
            'Kesehatan',
            'Pendidikan',
            'Olahraga',
            'Politik',
            'Sosial',
            'Lingkungan',
            'Pariwisata',
            'Otomotif',
            'Agama',
            'Teknologi Informasi',
            'Pemerintahan',
            'Peraturan',

        ];

        foreach ($teams as $team) {
            foreach ($tags as $tagName) {
                Tag::firstOrCreate(
                    [
                        'name' => $tagName,
                        'team_id' => $team->id
                    ],
                    [
                        'slug' => Str::slug($tagName),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
