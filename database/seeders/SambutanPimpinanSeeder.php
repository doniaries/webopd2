<?php

namespace Database\Seeders;

use App\Models\SambutanPimpinan;
use App\Models\Team;
use Illuminate\Database\Seeder;

class SambutanPimpinanSeeder extends Seeder
{
    public function run()
    {
        // Get all teams
        $teams = Team::all();
        
        if ($teams->isEmpty()) {
            $this->command->warn('No teams found. Please run TeamSeeder first!');
            return;
        }

        // Base data for welcome messages
        $sambutanData = [
            [
                'isi_sambutan' => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh

Puji syukur kehadirat Allah SWT, Tuhan Yang Maha Esa, atas rahmat dan karunia-Nya, kami dapat meluncurkan website resmi Pemerintah Kabupaten ini. Website ini hadir sebagai sarana untuk meningkatkan pelayanan publik yang transparan, akuntabel, dan partisipatif.

Melalui website ini, kami berkomitmen untuk menyajikan informasi yang akurat, aktual, dan bermanfaat bagi seluruh lapisan masyarakat. Kami juga membuka ruang partisipasi publik untuk memberikan masukan dan aspirasi guna perbaikan kinerja pemerintahan ke depan.

Terima kasih atas dukungan dan partisipasi semua pihak dalam mewujudkan pemerintahan yang bersih dan melayani.

Wassalamu\'alaikum Warahmatullahi Wabarakatuh',
            ],
        ];

        // Create welcome messages for each team
        foreach ($teams as $team) {
            // Check if welcome message already exists for this team
            if (!SambutanPimpinan::where('team_id', $team->id)->exists()) {
                foreach ($sambutanData as $data) {
                    // Add team-specific data
                    $sambutan = array_merge($data, [
                        'team_id' => $team->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Create the welcome message
                    SambutanPimpinan::create($sambutan);
                }
            }
        }
    }
}
