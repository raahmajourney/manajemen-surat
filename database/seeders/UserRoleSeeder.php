<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('admin');

        $dosen = User::firstOrCreate(
            ['email' => 'dosen@example.com'],
            [
                'name' => 'Dosen',
                'password' => bcrypt('password'),
            ]
        );
        $dosen->assignRole('dosen');

        $staf = User::firstOrCreate(
            ['email' => 'staf@example.com'],
            [
                'name' => 'Staf',
                'password' => bcrypt('password'),
            ]
        );
        $staf->assignRole('staf');
    }

}

