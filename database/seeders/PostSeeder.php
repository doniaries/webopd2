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
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Initialize faker
        $faker = Faker::create('id_ID');
        
        // Get all teams
        $teams = Team::all();

        if ($teams->isEmpty()) {
            $this->call(TeamSeeder::class);
            $teams = Team::all();
        }

        // Ensure we have categories
        if (Category::count() === 0) {
            $this->call(CategorySeeder::class);
        }

        // Ensure we have tags
        if (Tag::count() === 0) {
            $this->call(TagSeeder::class);
        }

        // Create directories if they don't exist
        $directories = ['public/featured-images', 'public/gallery-images'];
        foreach ($directories as $directory) {
            if (!File::exists(storage_path('app/' . $directory))) {
                File::makeDirectory(storage_path('app/' . $directory), 0755, true);
            }
        }

        // Sample berita titles and content templates
        $beritaTitles = [
            'Pemkot Luncurkan Program {program} untuk Tingkatkan {sektor}',
            'Kunjungan Kerja Walikota ke {tempat} Bahas {topik}',
            'Dinas {dinas} Gelar Sosialisasi {topik} di {tempat}',
            'Peresmian {fasilitas} di {tempat} oleh {pejabat}',
            'Raih Penghargaan {penghargaan}, {instansi} Buktikan Komitmen pada {bidang}',
            'Peringatan Hari {peringatan}: {instansi} Gelar {kegiatan}',
            'Musrenbang {tahun}: {instansi} Prioritaskan Pembangunan {sektor}',
            'Tingkatkan Pelayanan Publik, {instansi} Luncurkan {inovasi}',
            'Antisipasi {masalah}, {instansi} Siapkan {solusi}',
            'Kolaborasi {instansi} dengan {mitra} untuk Kembangkan {program}'
        ];

        $contentTemplates = [
             '<h2>{judul}</h2>
             <p>{kota}, {tanggal} - {instansi} resmi meluncurkan program {program} yang bertujuan untuk meningkatkan {sektor} di wilayah {kota}. Program ini merupakan bagian dari upaya pemerintah dalam mewujudkan visi {visi}.</p>
             
             <h3>Latar Belakang</h3>
             <p>Program ini dilatarbelakangi oleh {latar_belakang} yang telah menjadi perhatian pemerintah selama beberapa tahun terakhir. Melalui program ini, diharapkan dapat {harapan}.</p>
             
             <h3>Implementasi Program</h3>
             <p>Dalam pelaksanaannya, program {program} akan melibatkan berbagai pihak termasuk {pihak_terlibat}. Tahap awal implementasi akan dimulai di {lokasi_awal} sebelum diperluas ke wilayah lainnya.</p>
             
             <p>"{kutipan_pejabat}" ujar {pejabat} saat diwawancarai di lokasi acara.</p>
             
             <h3>Target dan Capaian</h3>
             <p>Program ini menargetkan {target} dalam jangka waktu {jangka_waktu}. Beberapa indikator keberhasilan yang akan dipantau antara lain {indikator}.</p>',
             
             '<h2>{judul}</h2>
             <p>{kota}, {tanggal} - {pejabat} melakukan kunjungan kerja ke {tempat} untuk membahas {topik} yang menjadi fokus pembangunan daerah. Kunjungan ini merupakan bagian dari rangkaian kegiatan {rangkaian}.</p>
             
             <h3>Agenda Kunjungan</h3>
             <p>Selama kunjungan, {pejabat} didampingi oleh {pendamping} melakukan beberapa aktivitas termasuk {aktivitas}. Pertemuan dengan {pihak_temui} menjadi agenda utama dalam kunjungan ini.</p>
             
             <h3>Hasil Pembahasan</h3>
             <p>Dari hasil pembahasan, disepakati beberapa poin penting yaitu {poin_penting}. Kesepakatan ini akan ditindaklanjuti dengan {tindak_lanjut} dalam waktu dekat.</p>
             
             <p>"{kutipan}" kata {pejabat} saat memberikan keterangan kepada media.</p>
             
             <h3>Rencana Ke Depan</h3>
             <p>Sebagai tindak lanjut dari kunjungan ini, akan dilaksanakan {rencana} yang diharapkan dapat {harapan}. Masyarakat diharapkan dapat {harapan_masyarakat} untuk mendukung program ini.</p>',
             
             '<h2>{judul}</h2>
             <p>{kota}, {tanggal} - Dinas {dinas} menggelar sosialisasi {topik} di {tempat} yang dihadiri oleh {peserta}. Kegiatan ini bertujuan untuk {tujuan} sebagai bagian dari program {program}.</p>
             
             <h3>Materi Sosialisasi</h3>
             <p>Dalam sosialisasi tersebut, disampaikan beberapa materi penting meliputi {materi}. Pemateri dari {asal_pemateri} menekankan pentingnya {penekanan} dalam implementasi {topik}.</p>
             
             <h3>Tanggapan Peserta</h3>
             <p>Para peserta memberikan tanggapan positif terhadap sosialisasi ini. "{kutipan_peserta}" ungkap {nama_peserta}, salah satu peserta dari {asal_peserta}.</p>
             
             <h3>Tindak Lanjut</h3>
             <p>Sebagai tindak lanjut dari sosialisasi ini, Dinas {dinas} akan {tindak_lanjut} untuk memastikan {hasil} dapat tercapai. Evaluasi akan dilakukan secara {periode_evaluasi} untuk memantau perkembangan implementasi.</p>'
         ];

         // Create 10 posts per team, specifically for the "Berita" category
        foreach ($teams as $team) {
            // Get admin user for this team
            $adminUser = User::whereHas('teams', function ($query) use ($team) {
                $query->where('teams.id', $team->id);
            })->whereHas('roles', function ($query) {
                $query->where('name', 'admin_opd');
            })->first();

            // If no admin found, get any user from the team
            if (!$adminUser) {
                $adminUser = User::whereHas('teams', function ($query) use ($team) {
                    $query->where('teams.id', $team->id);
                })->first();
            }

            // If still no user found, get the first super admin
            if (!$adminUser) {
                $adminUser = User::whereHas('roles', function ($query) {
                    $query->where('name', 'super_admin');
                })->first();
            }

            // Get the Berita category for this team
            $beritaCategory = Category::where('team_id', $team->id)
                ->where('name', 'Berita')
                ->first();

            // If Berita category doesn't exist, create it
            if (!$beritaCategory) {
                $beritaCategory = Category::create([
                    'team_id' => $team->id,
                    'name' => 'Berita',
                    'slug' => 'berita',
                    'is_active' => true
                ]);
            }

            // Get tags for this team
            $teamTags = Tag::where('team_id', $team->id)->get();

            // If no tags found, call TagSeeder and get tags again
            if ($teamTags->isEmpty()) {
                $this->call(TagSeeder::class);
                $teamTags = Tag::where('team_id', $team->id)->get();
            }

            // Create 10 posts for this team in the Berita category
            for ($i = 1; $i <= 10; $i++) {
                // Select a random title template and fill it with data
                $titleTemplate = $faker->randomElement($beritaTitles);
                
                // Replace placeholders with random data
                $title = str_replace(
                    ['{program}', '{sektor}', '{tempat}', '{topik}', '{dinas}', '{fasilitas}', '{pejabat}', 
                     '{penghargaan}', '{instansi}', '{bidang}', '{peringatan}', '{kegiatan}', '{tahun}', 
                     '{inovasi}', '{masalah}', '{solusi}', '{mitra}'],
                    [
                        $faker->randomElement(['Pemberdayaan Masyarakat', 'Digitalisasi Pelayanan', 'Revitalisasi Pasar', 'Pembangunan Infrastruktur', 'Pelatihan Keterampilan']),
                        $faker->randomElement(['Pendidikan', 'Kesehatan', 'Ekonomi', 'Pariwisata', 'Lingkungan Hidup']),
                        $faker->randomElement(['Kecamatan '.$faker->city, 'Kelurahan '.$faker->streetName, 'Balai Kota', 'Gedung Serbaguna', 'Taman Kota']),
                        $faker->randomElement(['Pengelolaan Anggaran Daerah', 'Peningkatan Kualitas Pendidikan', 'Penanganan Banjir', 'Pengembangan UMKM', 'Pelayanan Kesehatan']),
                        $faker->randomElement(['Pendidikan', 'Kesehatan', 'Perhubungan', 'Lingkungan Hidup', 'Pariwisata']),
                        $faker->randomElement(['Gedung Baru', 'Jembatan', 'Taman Kota', 'Puskesmas', 'Sekolah']),
                        $faker->randomElement(['Walikota', 'Wakil Walikota', 'Sekda', 'Kepala Dinas', 'Camat']),
                        $faker->randomElement(['Kota Sehat', 'Pelayanan Publik Terbaik', 'Kota Ramah Anak', 'Pengelolaan Keuangan Terbaik', 'Inovasi Daerah']),
                        $faker->randomElement(['Pemkot', 'Dinas Pendidikan', 'Dinas Kesehatan', 'Dinas Perhubungan', 'BAPPEDA']),
                        $faker->randomElement(['Pendidikan', 'Kesehatan', 'Lingkungan', 'Pelayanan Publik', 'Transparansi']),
                        $faker->randomElement(['Pendidikan', 'Kesehatan', 'Lingkungan', 'Anak', 'Pahlawan']),
                        $faker->randomElement(['Lomba Inovasi', 'Karnaval', 'Seminar', 'Pameran', 'Bakti Sosial']),
                        $faker->numberBetween(2023, 2025),
                        $faker->randomElement(['Aplikasi Pelayanan Terpadu', 'Sistem Informasi Terintegrasi', 'Smart City Dashboard', 'Kartu Pintar Warga', 'Portal Layanan Online']),
                        $faker->randomElement(['Banjir', 'Kemacetan', 'Sampah', 'Pengangguran', 'Stunting']),
                        $faker->randomElement(['Program Tanggap Darurat', 'Sistem Peringatan Dini', 'Relokasi Warga', 'Pelatihan Mitigasi', 'Bantuan Sosial']),
                        $faker->randomElement(['Universitas Lokal', 'Swasta', 'Komunitas', 'Pemerintah Pusat', 'Lembaga Internasional'])
                    ],
                    $titleTemplate
                );
                
                // Create a unique slug
                $slug = Str::slug($title) . '-' . $team->id . '-' . $i;
                
                // Select a random content template and fill it with data
                $contentTemplate = $faker->randomElement($contentTemplates);
                
                // Replace content placeholders with random data
                $content = str_replace(
                    ['{judul}', '{kota}', '{tanggal}', '{instansi}', '{program}', '{sektor}', '{visi}', 
                     '{latar_belakang}', '{harapan}', '{pihak_terlibat}', '{lokasi_awal}', '{kutipan_pejabat}', 
                     '{pejabat}', '{target}', '{jangka_waktu}', '{indikator}', '{tempat}', '{topik}', 
                     '{rangkaian}', '{pendamping}', '{aktivitas}', '{pihak_temui}', '{poin_penting}', 
                     '{tindak_lanjut}', '{kutipan}', '{rencana}', '{harapan_masyarakat}', '{dinas}', 
                     '{peserta}', '{tujuan}', '{materi}', '{asal_pemateri}', '{penekanan}', 
                     '{kutipan_peserta}', '{nama_peserta}', '{asal_peserta}', '{hasil}', '{periode_evaluasi}'],
                    [
                        $title,
                        $faker->city,
                        $faker->date('d F Y'),
                        $faker->randomElement(['Pemerintah Kota', 'Dinas Pendidikan', 'Dinas Kesehatan', 'Dinas Perhubungan', 'BAPPEDA']),
                        $faker->randomElement(['Pemberdayaan Masyarakat', 'Digitalisasi Pelayanan', 'Revitalisasi Pasar', 'Pembangunan Infrastruktur', 'Pelatihan Keterampilan']),
                        $faker->randomElement(['Pendidikan', 'Kesehatan', 'Ekonomi', 'Pariwisata', 'Lingkungan Hidup']),
                        $faker->randomElement(['Kota Cerdas', 'Kota Sehat', 'Kota Ramah Anak', 'Kota Berkelanjutan', 'Kota Inovatif']),
                        $faker->paragraph(),
                        $faker->sentence(),
                        $faker->randomElement(['masyarakat, akademisi, dan pelaku usaha', 'berbagai OPD terkait', 'komunitas dan LSM', 'pemerintah pusat dan daerah', 'sektor swasta dan BUMN']),
                        $faker->randomElement(['Kecamatan '.$faker->city, 'Kelurahan '.$faker->streetName, 'kawasan pusat kota', 'daerah pinggiran kota', 'kawasan industri']),
                        $faker->sentence(),
                        $faker->randomElement(['Walikota', 'Wakil Walikota', 'Sekda', 'Kepala Dinas', 'Camat']) . ' ' . $faker->name(),
                        $faker->sentence(),
                        $faker->randomElement(['1 tahun', '2 tahun', '5 tahun', '6 bulan', '3 bulan']),
                        $faker->paragraph(),
                        $faker->randomElement(['Kecamatan '.$faker->city, 'Kelurahan '.$faker->streetName, 'Balai Kota', 'Gedung Serbaguna', 'Taman Kota']),
                        $faker->randomElement(['Pengelolaan Anggaran Daerah', 'Peningkatan Kualitas Pendidikan', 'Penanganan Banjir', 'Pengembangan UMKM', 'Pelayanan Kesehatan']),
                        $faker->randomElement(['Musrenbang', 'Rapat Koordinasi', 'Peninjauan Pembangunan', 'Evaluasi Program', 'Sosialisasi Kebijakan']),
                        $faker->randomElement(['jajaran kepala OPD', 'anggota DPRD', 'staf ahli', 'perwakilan kementerian', 'tim teknis']),
                        $faker->paragraph(),
                        $faker->randomElement(['tokoh masyarakat', 'pelaku usaha', 'perwakilan warga', 'komunitas pemuda', 'kelompok perempuan']),
                        $faker->paragraph(),
                        $faker->randomElement(['penandatanganan MoU', 'pembentukan tim khusus', 'alokasi anggaran', 'penyusunan regulasi', 'pengadaan peralatan']),
                        $faker->sentence(),
                        $faker->randomElement(['forum diskusi lanjutan', 'pelatihan', 'pembentukan kelompok kerja', 'studi banding', 'uji coba program']),
                        $faker->sentence(),
                        $faker->randomElement(['Pendidikan', 'Kesehatan', 'Perhubungan', 'Lingkungan Hidup', 'Pariwisata']),
                        $faker->randomElement(['para kepala sekolah', 'tenaga kesehatan', 'pelaku UMKM', 'ketua RT/RW', 'pegawai kelurahan']),
                        $faker->sentence(),
                        $faker->paragraph(),
                        $faker->randomElement(['Kementerian terkait', 'Perguruan Tinggi', 'Lembaga Sertifikasi', 'Konsultan Ahli', 'Praktisi Berpengalaman']),
                        $faker->sentence(),
                        $faker->sentence(),
                        $faker->name(),
                        $faker->randomElement(['Kecamatan '.$faker->city, 'Kelurahan '.$faker->streetName, 'Asosiasi Profesi', 'Komunitas', 'Lembaga Pendidikan']),
                        $faker->sentence(),
                        $faker->randomElement(['bulanan', 'triwulanan', 'semesteran', 'tahunan', 'berkelanjutan'])
                    ],
                    $contentTemplate
                );
                
                // Determine publication date (spread over last 3 months)
                $daysAgo = $faker->numberBetween(0, 90);
                $publishedAt = now()->subDays($daysAgo);
                
                // Create the post
                $post = Post::create([
                    'team_id' => $team->id,
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'category_id' => $beritaCategory->id,
                    'user_id' => $adminUser->id,
                    'status' => 'published',
                    'published_at' => $publishedAt,
                    'views' => $faker->numberBetween(0, 500),
                    'featured_image' => 'featured-images/featured-' . $faker->numberBetween(1, 4) . '.jpg',
                    'gallery_images' => $faker->boolean(70) ? json_encode(['gallery-images/gallery-' . $faker->numberBetween(1, 4) . '-' . $faker->numberBetween(1, 2) . '.jpg']) : json_encode([]),
                ]);
                
                // Attach the category to the post through the many-to-many relationship
                $post->categories()->attach($beritaCategory->id, ['team_id' => $team->id]);
                
                // Attach 2-4 random tags to the post
                $randomTags = $teamTags->random($faker->numberBetween(2, 4));
                foreach ($randomTags as $tag) {
                    $post->tags()->attach($tag->id, ['team_id' => $team->id]);
                }
                
                $this->command->info("Post '{$title}' for team '{$team->name}' created successfully!");
            }
        }
    }
}
