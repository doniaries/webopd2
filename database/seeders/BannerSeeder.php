<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BannerSeeder extends Seeder
{
    private $imageUrls = [
        'https://img.freepik.com/free-vector/gradient-ui-ux-background_23-2149052117.jpg?w=1380&t=st=1650000000',
        'https://img.freepik.com/free-vector/gradient-network-connection-background_23-2148865392.jpg?w=1380&t=st=1650000000',
        'https://img.freepik.com/free-vector/gradient-technology-background_23-2148884635.jpg?w=1380&t=st=1650000000',
        'https://img.freepik.com/free-vector/gradient-technology-background_23-2148884636.jpg?w=1380&t=st=1650000000',
        'https://img.freepik.com/free-vector/gradient-technology-background_23-2148884637.jpg?w=1380&t=st=1650000000',
    ];

    public function run(): void
    {
        // Get all teams
        $teams = Team::all();

        if ($teams->isEmpty()) {
            $this->command->warn('No teams found. Please run TeamSeeder first!');
            return;
        }


        // Create directory if not exists
        if (!Storage::disk('public')->exists('banners')) {
            Storage::disk('public')->makeDirectory('banners');
        }

        // Create banners for each team
        foreach ($teams as $team) {
            for ($i = 1; $i <= 5; $i++) {
                $imageUrl = $this->imageUrls[$i - 1];
                $imageName = 'banner-' . Str::slug($team->name) . '-' . $i . '.jpg';
                $imagePath = 'banners/' . $imageName;

                // Download and save image
                try {
                    $image = Http::get($imageUrl);
                    Storage::disk('public')->put($imagePath, $image->body());
                } catch (\Exception $e) {
                    $this->command->error('Failed to download image: ' . $e->getMessage());
                    continue;
                }

                Banner::create([
                    'team_id' => $team->id,
                    'judul' => 'Banner ' . $i . ' - ' . $team->name,
                    'gambar' => $imageName,
                    'keterangan' => 'Banner promosi untuk ' . $team->name . ' - Link: https://' . Str::slug($team->name) . '.example.com',
                    'is_active' => true
                ]);
            }
        }

        $this->command->info('Successfully created banners for all teams!');
    }
}
