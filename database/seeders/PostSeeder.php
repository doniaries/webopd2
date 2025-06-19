<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
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
                'content' => '<h2>Selamat Datang di Platform Digital Kami</h2>
                <p>Dengan penuh kebanggaan, kami meluncurkan website resmi terbaru kami yang dirancang untuk memberikan pengalaman terbaik bagi seluruh pengunjung. Website ini hadir dengan antarmuka yang lebih interaktif dan informatif, memudahkan Anda mengakses berbagai layanan dan informasi terbaru dari kami.</p>
                
                <h3>Fitur Terbaru</h3>
                <ul>
                    <li>Navigasi yang lebih intuitif dan mudah digunakan</li>
                    <li>Konten yang lebih kaya dan informatif</li>
                    <li>Responsif di berbagai perangkat</li>
                    <li>Keamanan data yang terjamin</li>
                </ul>
                
                <h3>Layanan Unggulan</h3>
                <p>Kami menyediakan berbagai layanan unggulan yang dapat Anda akses langsung melalui website ini. Mulai dari informasi produk terbaru, panduan penggunaan, hingga layanan pelanggan yang siap membantu 24/7.</p>
                
                <p>Jangan ragu untuk menjelajahi setiap bagian website kami dan temukan berbagai informasi menarik seputar layanan yang kami tawarkan.</p>',
                'status' => 'published',
                'published_at' => now(),
                'featured_image' => 'featured-images/featured-1.jpg',
                'gallery_images' => json_encode(['gallery-images/gallery-1-1.jpg', 'gallery-images/gallery-1-2.jpg']),
            ],
            [
                'title' => 'Pengumuman Penting: Perubahan Jam Operasional',
                'slug' => 'pengumuman-perubahan-jam-operasional',
                'content' => '<h2>Perubahan Jam Operasional Layanan Kami</h2>
                <p>Sehubungan dengan peningkatan layanan, kami ingin menginformasikan bahwa akan ada penyesuaian jam operasional mulai minggu depan, Senin, 24 Juni 2025.</p>
                
                <h3>Jam Operasional Baru</h3>
                <ul>
                    <li><strong>Senin - Kamis:</strong> 08.00 - 17.00 WIB</li>
                    <li><strong>Jumat:</strong> 08.00 - 16.30 WIB</li>
                    <li><strong>Sabtu - Minggu:</strong> Tutup</li>
                </ul>
                
                <h3>Layanan Online Tetap Berjalan 24/7</h3>
                <p>Meskipun ada perubahan jam operasional, layanan online kami tetap dapat diakses 24 jam melalui website dan aplikasi mobile kami. Tim dukungan teknis kami juga siap membantu melalui live chat selama jam operasional.</p>
                
                <p>Kami mohon maaf atas ketidaknyamanan ini dan berterima kasih atas pengertian serta dukungan Bapak/Ibu selama ini.</p>',
                'status' => 'published',
                'published_at' => now(),
                'featured_image' => 'featured-images/featured-2.jpg',
                'gallery_images' => json_encode(['gallery-images/gallery-2-1.jpg']),
            ],
            [
                'title' => '10 Tips dan Trik Merawat Perangkat Elektronik Anda',
                'slug' => 'tips-dan-trik-cara-merawat-perangkat-anda',
                'content' => '<h2>Panduan Lengkap Merawat Perangkat Elektronik</h2>
                <p>Perangkat elektronik yang terawat dengan baik tidak hanya bertahan lebih lama tetapi juga berkinerja lebih optimal. Berikut adalah 10 tips merawat perangkat elektronik kesayangan Anda:</p>
                
                <h3>1. Bersihkan Secara Berkala</h3>
                <p>Debu dan kotoran dapat menyumbat ventilasi dan menyebabkan overheating. Gunakan kain microfiber dan pembersih khusus untuk membersihkan layar dan bodi perangkat.</p>
                
                <h3>2. Hindari Panas Berlebih</h3>
                <p>Jangan biarkan perangkat terkena sinar matahari langsung atau suhu ekstrem. Panas berlebih dapat merusak komponen internal.</p>
                
                <h3>3. Update Software Secara Berkala</h3>
                <p>Selalu perbarui sistem operasi dan aplikasi untuk mendapatkan perbaikan keamanan dan peningkatan performa terbaru.</p>
                
                <h3>4. Gunakan Pelindung Layar dan Case</h3>
                <p>Investasikan pada pelindung layar dan case yang berkualitas untuk melindungi perangkat dari goresan dan benturan.</p>
                
                <h3>5. Kelola Daya dengan Bijak</h3>
                <p>Hindari pengisian daya semalaman. Sebaiknya cabut charger saat baterai sudah mencapai 80-90% untuk memperpanjang umur baterai.</p>',
                'status' => 'published',
                'published_at' => now(),
                'featured_image' => 'featured-images/featured-3.jpg',
                'gallery_images' => json_encode([]),
            ],
            [
                'title' => 'Inovasi Terbaru: Teknologi Masa Depan Hadir Hari Ini',
                'slug' => 'inovasi-terbaru-dari-tim-kami',
                'content' => '<h2>Mengubah Masa Depan dengan Inovasi Terkini</h2>
                <p>Kami dengan bangga mempersembahkan terobosan terbaru yang akan merevolusi cara Anda berinteraksi dengan teknologi. Setelah melalui penelitian dan pengembangan yang intensif, tim kami berhasil menciptakan solusi inovatif yang menggabungkan kecanggihan teknologi dengan kemudahan penggunaan.</p>
                
                <h3>Fitur Unggulan</h3>
                <div class="features-grid">
                    <div class="feature-item">
                        <h4>Kinerja Tinggi</h4>
                        <p>Ditenagai oleh prosesor generasi terbaru yang 50% lebih cepat dari versi sebelumnya.</p>
                    </div>
                    <div class="feature-item">
                        <h4>Desain Ergonomis</h4>
                        <p>Dirancang untuk kenyamanan maksimal dengan bobot yang ringan dan bentuk yang pas di tangan.</p>
                    </div>
                    <div class="feature-item">
                        <h4>Masa Pakai Baterai Lama</h4>
                        <p>Teknologi baterai mutakhir yang mampu bertahan hingga 20 jam pemakaian normal.</p>
                    </div>
                </div>
                
                <h3>Teknologi Terdepan</h3>
                <p>Produk ini dilengkapi dengan teknologi AI canggih yang mampu belajar dari kebiasaan pengguna, memberikan pengalaman yang semakin personal dari waktu ke waktu. Sistem keamanan multi-layer kami menjamin perlindungan data Anda tetap terjaga.</p>
                
                <h3>Ketersediaan</h3>
                <p>Produk ini akan tersedia mulai bulan depan. Dapatkan penawaran pra-pesan khusus dengan diskon 15% untuk 100 pembeli pertama.</p>',
                'status' => 'published',
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
                        'views' => rand(0, 50),
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
