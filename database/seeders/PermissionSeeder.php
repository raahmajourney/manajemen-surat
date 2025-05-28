<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat permission dasar
        $permissions = [
            'akses dashboard',
            'kelola pengaturan',
            'buat surat',
            'edit surat',
            'hapus surat',
            'lihat surat',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Buat role dan berikan permission
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staf = Role::firstOrCreate(['name' => 'staf']);
        $dosen = Role::firstOrCreate(['name' => 'dosen']);

        // Admin bisa semua
        $admin->syncPermissions(Permission::all());

        // Staf hanya sebagian
        $staf->syncPermissions([
            'akses dashboard',
            'buat surat',
            'edit surat',
            'lihat surat',
        ]);

        // Dosen hanya buat dan lihat
        $dosen->syncPermissions([
            'akses dashboard',
            'buat surat',
            'lihat surat',
        ]);
    
    }
}
