<?php

namespace Database\Seeders;

use App\Models\ProdukHukum;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProdukHukumSeeder extends Seeder
{
    public function run()
    {
        // Get all teams
        $teams = Team::all();

        if ($teams->isEmpty()) {
            $this->command->warn('No teams found. Please run TeamSeeder first!');
            return;
        }

        // Base data for legal products
        $produkHukumData = [
            [
                'judul' => 'Peraturan Daerah Nomor 1 Tahun 2025 tentang Penyelenggaraan Pemerintahan Daerah',
                'slug' => Str::slug('Peraturan Daerah Nomor 1 Tahun 2025 tentang Penyelenggaraan Pemerintahan Daerah'),
                'uraian' => 'Peraturan Daerah ini mengatur tentang penyelenggaraan pemerintahan daerah yang bersih dan berwibawa.',
                'file' => 'perda-1-tahun-2025.pdf',
            ],
            [
                'judul' => 'Peraturan Bupati Nomor 5 Tahun 2025 tentang Standar Pelayanan Publik',
                'slug' => Str::slug('Peraturan Bupati Nomor 5 Tahun 2025 tentang Standar Pelayanan Publik'),
                'uraian' => 'Peraturan ini menetapkan standar pelayanan publik di lingkungan Pemerintah Kabupaten.',
                'file' => 'perbup-5-tahun-2025.pdf',
            ],
            [
                'judul' => 'Surat Edaran Bupati Nomor 10 Tahun 2025 tentang Pencegahan Penyebaran COVID-19',
                'slug' => Str::slug('Surat Edaran Bupati Nomor 10 Tahun 2025 tentang Pencegahan Penyebaran COVID-19'),
                'uraian' => 'Surat edaran ini berisi tentang langkah-langkah pencegahan penyebaran COVID-19 di lingkungan kerja.',
                'file' => 'se-bupati-10-tahun-2025.pdf',
            ],
        ];

        // Create legal products for each team
        foreach ($teams as $team) {
            foreach ($produkHukumData as $data) {
                // Make slug unique by appending team ID
                $uniqueSlug = $data['slug'] . '-' . $team->id;
                
                // Add team-specific data with unique slug
                $produkHukum = array_merge($data, [
                    'slug' => $uniqueSlug,
                    'team_id' => $team->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Create the legal product
                ProdukHukum::create($produkHukum);
            }
        }
    }
}
