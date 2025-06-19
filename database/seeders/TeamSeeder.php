<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Function to generate slug from name
        $createSlug = function ($name) {
            return Str::slug($name, '-');
        };

        // Function to create domain from name
        $createDomain = function ($name) use ($createSlug) {
            $base = str_replace(' ', '', strtolower($name));
            return $createSlug($name) . '.sijunjung.go.id';
        };

        // Get super admin user
        $superAdmin = User::where('email', 'admin@example.com')->first();

        // List of organizations
        $teams = [

            'Dinas Komunikasi Dan Informatika',
            'Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia',
            // 'Badan Keuangan Dan Aset Daerah',
            // 'Badan Penanggulangan Bencana Daerah',
            // 'Badan Perencanaan, Penelitian Dan Pengembangan Daerah',
            // 'Dinas Kependudukan Dan Pencatatan Sipil',
            // 'Dinas Kesehatan',
            // 'Dinas Ketenagakerjaan Dan Transmigrasi',
            // 'Dinas Pangan Dan Perikanan',
            // 'Dinas Pariwisata, Pemuda Dan Olah Raga',
            // 'Dinas Pekerjaan Umum Dan Penataan Ruang',
            // 'Dinas Pemberdayaan Masyarakat Dan Nagari',
            // 'Dinas PMPTSP',
            // 'Dinas Pendidikan Dan Kebudayaan',
            // 'Dinas Pengendalian Penduduk Dan Keluarga Berencana',
            // 'Dinas Perdagangan, Perindustrian Koperasi Usaha Kecil Dan Menengah',
            // 'Dinas Perhubungan',
            // 'Dinas Perpustakaan Dan Kearsipan',
            // 'Dinas Pertanian',
            // 'Dinas Perumahan, Kawasan Permukiman Dan Lingkungan Hidup',
            // 'Dinas Sosial, Pemberdayaan Perempuan Dan Perlindungan Anak',

            // // Instansi Lainnya
            // 'Inspektorat Daerah',
            // 'Kantor Kesatuan Bangsa Dan Politik',
            // 'Rumah Sakit Umum Daerah (RSUD)',
            // 'Satuan Polisi Pamong Praja Dan Pemadam Kebakaran',
            // 'Sekretariat Daerah',
            // 'Sekretariat DPRD',
            // 'Dharma Wanita',
            // 'Dekranasda',
            // 'Gudang Farmasi',
            // 'Labkesda',

            // // Kecamatan
            // 'Kecamatan IV Nagari',
            // 'Kecamatan Kamang Baru',
            // 'Kecamatan Koto VII',
            // 'Kecamatan Kupitan',
            // 'Kecamatan Lubuk Tarok',
            // 'Kecamatan Sijunjung',
            // 'Kecamatan Sumpur Kudus',
            // 'Kecamatan Tanjung Gadang',

            // // Puskesmas
            // 'Puskesmas Sijunjung',
            // 'Puskesmas Gambok',
            // 'Puskesmas Muaro Bodi',
            // 'Puskesmas Lubuk Tarok',
            // 'Puskesmas Padang Sibusuk',
            // 'Puskesmas Tanjung Ampalu',
            // 'Puskesmas Kumanis',
            // 'Puskesmas Sumpur Kudus',
            // 'Puskesmas Tanjung Gadang',
            // 'Puskesmas Sungai Lansek',
            // 'Puskesmas Air Amo',
            // 'Puskesmas Kamang',

            // // BPP
            // 'BPP Sijunjung',
            // 'BPP IV Nagari',
            // 'BPP Lubuk Tarok',
            // 'BPP Kupitan',
            // 'BPP Koto VII',
            // 'BPP Sumpur Kudus',
            // 'BPP Tanjung Gadang',
            // 'BPP Kamang Baru',

            // // Nagari/Desa
            // 'Nagari Palangki',
            // 'Nagari Koto Baru',
            // 'Nagari Muaro Bodi',
            // 'Nagari Mundam Sakti',
            // 'Nagari Koto Tuo',
            // 'Nagari Sungai Lansek',
            // 'Nagari Kamang',
            // 'Nagari Muaro Takuang',
            // 'Nagari Aia Amo',
            // 'Nagari Sungai Batuang',
            // 'Nagari Kunangan Parit Rantang',
            // 'Nagari Tanjuang Kaliang',
            // 'Nagari Padang Tarok',
            // 'Nagari Siaur',
            // 'Nagari Lubuk Tarantang',
            // 'Nagari Maloro',
            // 'Nagari Limo Koto',
            // 'Nagari Palaluar',
            // 'Nagari Guguk',
            // 'Nagari Padang Laweh',
            // 'Nagari Tanjung',
            // 'Nagari Bukit Bual',
            // 'Nagari Padang Laweh Selatan',
            // 'Nagari Batu Manjulur',
            // 'Nagari Pamuatan',
            // 'Nagari Padang Sibusuk',
            // 'Desa Kampung Baru',
            // 'Nagari Lubuk Tarok',
            // 'Nagari Lalan',
            // 'Nagari Buluh Kasok',
            // 'Nagari Kampung Dalam',
            // 'Nagari Latang',
            // 'Nagari Silongo',
            // 'Nagari Muaro',
            // 'Nagari Kandang Baru',
            // 'Nagari Silokek',
            // 'Nagari Pematang Panjang',
            // 'Nagari Solok Ambah',
            // 'Nagari Paru',
            // 'Nagari Durian Gadang',
            // 'Nagari Aie Angek',
            // 'Nagari Sijunjung',
            // 'Nagari Silantai',
            // 'Nagari Sisawah',
            // 'Nagari Unggan',
            // 'Nagari Tanjung Bonai Aur',
            // 'Nagari Sumpur Kudus',
            // 'Nagari Tamparungo',
            // 'Nagari Kumanis',
            // 'Nagari Mangganti',
            // 'Nagari Sumpur Kudus Selatan',
            // 'Nagari Tanjung Labuh',
            // 'Nagari Tanjung Bonai Aur Selatan',
            // 'Nagari Timbulun',
            // 'Nagari Tanjung Gadang',
            // 'Nagari Taratak Baru',
            // 'Nagari Pulasan',
            // 'Nagari Langki',
            // 'Nagari Sibakur',
            // 'Nagari Tanjung Lolo',
            // 'Nagari Taratak Baru Utara',
            // 'Nagari Sinyamu'
        ];



        // Create organizations
        foreach ($teams as $teamName) {
            $slug = $createSlug($teamName);
            $domain = $createDomain($teamName);

            $org = Team::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $teamName,
                    'slug' => $slug,
                    'singkatan' => null,
                    'url_logo' => null,
                    'alamat' => 'Jl. Contoh Alamat',
                    'nomor_telepon' => '(0754) 000000',
                    'email_organisasi' => "info@{$domain}",
                    'website_organisasi' => "https://{$domain}",
                    'facebook' => null,
                    'twitter' => null,
                    'instagram' => null,
                    'youtube' => null,
                    'is_active' => true,
                ]
            );

            // Attach super admin to this organization
            if ($superAdmin) {
                $org->users()->syncWithoutDetaching([$superAdmin->id]);
            }
        }

        $this->command->info('Teams seeder Sukses Ditambahkan!');
    }
}
