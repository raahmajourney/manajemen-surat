<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            JenisSuratsTableSeeder::class,
            UnitKerjaSeeder::class,
            RoleSeeder::class, 
             UserRoleSeeder::class,
        ]);
            
        // Membuat role admin dan user
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);


          // Buat akun admin default
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ump.ac.id',
            'password' => bcrypt('admin1234'),
        ])->assignRole('admin');


    }


    

    
    
}
