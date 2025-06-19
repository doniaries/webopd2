<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Get all posts
            $posts = Post::all();

            if ($posts->isEmpty()) {
                $this->command->warn('No posts found. Please run PostSeeder first!');
                return;
            }

            // Get all categories
            $categories = Category::all();

            if ($categories->isEmpty()) {
                $this->command->warn('No categories found. Please run CategorySeeder first!');
                return;
            }

            // Get team
            $team = Team::first();

            if (!$team) {
                $this->command->warn('No team found. Please run TeamSeeder first!');
                return;
            }

            $this->command->info('Associating posts with categories...');

            // Clear existing pivot data
            DB::table('post_categories')->truncate();

            // Associate each post with at least one category
            foreach ($posts as $post) {
                // Get random number of categories (1-3)
                $numCategories = rand(1, min(3, $categories->count()));

                // Get random categories
                $randomCategories = $categories->random($numCategories);

                foreach ($randomCategories as $category) {
                    DB::table('post_categories')->insert([
                        'team_id' => $team->id,
                        'post_id' => $post->id,
                        'category_id' => $category->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            $this->command->info('Successfully associated posts with categories!');
        } catch (\Exception $e) {
            $this->command->error('Error associating posts with categories: ' . $e->getMessage());
            $this->command->error($e->getTraceAsString());
        }
    }
}
