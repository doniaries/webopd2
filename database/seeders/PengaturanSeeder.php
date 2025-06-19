<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $teams = Team::all();

        if ($teams->isEmpty()) {
            $this->command->warn('No teams found. Please run TeamSeeder first!');
            return;
        }

        foreach ($teams as $team) {
            $domain = Str::slug($team->name) . '.localhost';

            Pengaturan::updateOrCreate(
                ['team_id' => $team->id],
                [
                    'nama_website' => $team->name,
                    'alamat_instansi' => 'Jl. Contoh No. 123, ' . $team->name,
                    'no_telp_instansi' => '+62 123 4567 890',
                    'email_instansi' => 'info@' . $domain,
                    'logo_instansi' => null,
                    'favicon_instansi' => null,
                    'facebook' => 'https://facebook.com/' . Str::slug($team->name),
                    'twitter' => 'https://twitter.com/' . Str::slug($team->name),
                    'instagram' => 'https://instagram.com/' . Str::slug($team->name),
                    'youtube' => 'https://youtube.com/' . Str::slug($team->name),
                ]
            );
        }

        $this->command->info('Successfully created settings for all teams!');
    }
}
