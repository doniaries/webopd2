<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Clear existing data
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('team_user')->truncate();
        DB::table('users')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('@Iamsuperadmin'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $superAdmin->syncRoles(['super_admin']);

        // Get all organizations
        $teams = Team::all();

        // Give super admin access to all organizations
        $superAdmin->teams()->sync($teams->pluck('id'));

        // Get all teams
        $teams = Team::all();


        // Create Admin OPD for each team
        foreach ($teams as $team) {
            $adminOpd = User::create([
                'name' => "Admin OPD " . $team->name,
                'email' => 'admin.' . $team->slug . '@gmail.com',
                'password' => Hash::make('password'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]);

            $adminOpd->syncRoles(['admin_opd']);
            $adminOpd->teams()->attach($team->id);

            $this->command->info("Admin OPD for {$team->name} created successfully!");
        }

        $this->command->info('User seeding completed!');
    }
}
