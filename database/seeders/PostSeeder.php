<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Get all teams
        $teams = Team::all();

        if ($teams->isEmpty()) {
            $this->call(TeamSeeder::class);
            $teams = Team::all();
        }

        // Get or create admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Ensure user is attached to all teams
        foreach ($teams as $team) {
            if (!$user->teams->contains($team->id)) {
                $user->teams()->attach($team);
            }
        }

        // Ensure we have categories
        if (Category::count() === 0) {
            $this->call(CategorySeeder::class);
        }

        // Sample post data with richer content
        $posts = [
            [
                'title' => 'Selamat Datang di Website Resmi Kami',
                'slug' => 'selamat-datang-di-website-resmi-kami',
                'content' => '<p>Kami dengan bangga mempersembahkan website resmi kami yang baru. Di sini Anda akan menemukan berbagai informasi terbaru seputar kegiatan, produk, dan layanan yang kami tawarkan.</p>',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now(),
                'featured_image' => 'featured-images/featured-1.jpg',
                'gallery_images' => json_encode(['gallery-images/gallery-1-1.jpg', 'gallery-images/gallery-1-2.jpg']),
            ],
            [
                'title' => 'Pengumuman Penting: Perubahan Jam Operasional',
                'slug' => 'pengumuman-perubahan-jam-operasional',
                'content' => '<p>Diberitahukan kepada seluruh pelanggan bahwa mulai minggu depan akan ada perubahan jam operasional kami.</p>',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now(),
                'featured_image' => 'featured-images/featured-2.jpg',
                'gallery_images' => json_encode(['gallery-images/gallery-2-1.jpg']),
            ],
            [
                'title' => 'Tips dan Trik: Cara Merawat Perangkat Anda',
                'slug' => 'tips-dan-trik-cara-merawat-perangkat-anda',
                'content' => '<p>Berikut beberapa tips untuk merawat perangkat Anda agar tetap awet dan tahan lama.</p>',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now(),
                'featured_image' => 'featured-images/featured-3.jpg',
                'gallery_images' => json_encode([]),
            ],
            [
                'title' => 'Inovasi Terbaru dari Tim Kami',
                'slug' => 'inovasi-terbaru-dari-tim-kami',
                'content' => '<p>Kami dengan bangga mempersembahkan inovasi terbaru yang akan mengubah cara Anda berinteraksi dengan teknologi.</p>',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(1),
                'featured_image' => 'featured-images/featured-4.jpg',
                'gallery_images' => json_encode(['gallery-images/gallery-4-1.jpg', 'gallery-images/gallery-4-2.jpg']),
            ],
        ];

        // Create posts for each team
        foreach ($teams as $team) {
            // Get categories for this team
            $teamCategories = Category::where('team_id', $team->id)->get();

            if ($teamCategories->isEmpty()) {
                $this->call(CategorySeeder::class);
                $teamCategories = Category::where('team_id', $team->id)->get();
                
                if ($teamCategories->isEmpty()) {
                    continue;
                }
            }

            // Create directories if they don't exist
            $directories = ['public/featured-images', 'public/gallery-images'];
            foreach ($directories as $directory) {
                if (!File::exists(storage_path('app/' . $directory))) {
                    File::makeDirectory(storage_path('app/' . $directory), 0755, true);
                }
            }

            foreach ($posts as $index => $postData) {
                // Get a random category for this post
                $category = $teamCategories->random();

                // Create the post
                $post = Post::firstOrCreate(
                    [
                        'team_id' => $team->id,
                        'slug' => $postData['slug'],
                    ],
                    array_merge($postData, [
                        'user_id' => $user->id,
                        'views' => rand(0, 1000),
                        'category_id' => $category->id,
                        'featured_image' => $postData['featured_image'] ?? null,
                        'gallery_images' => $postData['gallery_images'] ?? [],
                    ])
                );

                // Attach the category to the post through the many-to-many relationship
                if ($post->wasRecentlyCreated) {
                    $post->categories()->attach($category, ['team_id' => $team->id]);
                }
            }
        }
    }
}
