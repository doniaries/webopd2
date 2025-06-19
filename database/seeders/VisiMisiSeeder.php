<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\VisiMisi;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    public function run()
    {
        // Get all teams
        $teams = Team::all();

        if ($teams->isEmpty()) {
            $this->command->warn('No teams found. Please run TeamSeeder first!');
            return;
        }

        // Base data for vision and mission
        $visiMisiData = [
            [
                'visi' => 'Mewujudkan Pemerintahan yang Bersih, Melayani, dan Berintegritas untuk Kesejahteraan Masyarakat',
                'misi' => '1. Meningkatkan kualitas pelayanan publik yang prima dan berkeadilan
                            2. Mewujudkan tata kelola pemerintahan yang baik dan bersih
3. Mendorong pertumbuhan ekonomi yang inklusif dan berkelanjutan
4. Meningkatkan kualitas sumber daya manusia yang unggul dan berdaya saing
5. Mewujudkan pembangunan yang berwawasan lingkungan dan berkelanjutan',
            ],
        ];

        // Create vision and mission for each team
        foreach ($teams as $team) {
            foreach ($visiMisiData as $data) {
                // Add team-specific data
                $visiMisi = array_merge($data, [
                    'team_id' => $team->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Create the vision and mission
                VisiMisi::create($visiMisi);
            }
        }
    }
}
