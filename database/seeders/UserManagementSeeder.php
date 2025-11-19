<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserManagementSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Basic Permissions
        $permissions = [
            ['name' => 'Lihat Dashboard', 'slug' => 'view-dashboard', 'description' => 'Dapat mengakses dashboard', 'module' => 'dashboard'],
            ['name' => 'Lihat Pengguna', 'slug' => 'view-users', 'description' => 'Dapat melihat daftar pengguna', 'module' => 'users'],
            ['name' => 'Buat Pengguna', 'slug' => 'create-users', 'description' => 'Dapat membuat pengguna baru', 'module' => 'users'],
            ['name' => 'Edit Pengguna', 'slug' => 'edit-users', 'description' => 'Dapat mengedit pengguna yang ada', 'module' => 'users'],
            ['name' => 'Hapus Pengguna', 'slug' => 'delete-users', 'description' => 'Dapat menghapus pengguna', 'module' => 'users'],
            ['name' => 'Lihat Peran', 'slug' => 'view-roles', 'description' => 'Dapat melihat daftar peran', 'module' => 'roles'],
            ['name' => 'Buat Peran', 'slug' => 'create-roles', 'description' => 'Dapat membuat peran baru', 'module' => 'roles'],
            ['name' => 'Edit Peran', 'slug' => 'edit-roles', 'description' => 'Dapat mengedit peran yang ada', 'module' => 'roles'],
            ['name' => 'Hapus Peran', 'slug' => 'delete-roles', 'description' => 'Dapat menghapus peran', 'module' => 'roles'],
            ['name' => 'Lihat Hak Akses', 'slug' => 'view-permissions', 'description' => 'Dapat melihat daftar hak akses', 'module' => 'permissions'],
            ['name' => 'Lihat Aktivitas', 'slug' => 'view-activities', 'description' => 'Dapat melihat aktivitas pengguna', 'module' => 'activities'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }

        // Create Roles
        $superAdminRole = Role::updateOrCreate(
            ['slug' => 'super-admin'],
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Akses penuh ke semua fitur sistem',
            ]
        );

        $adminRole = Role::updateOrCreate(
            ['slug' => 'admin'],
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Akses administratif untuk manajemen pengguna',
            ]
        );

        $userRole = Role::updateOrCreate(
            ['slug' => 'user'],
            [
                'name' => 'Pengguna Biasa',
                'slug' => 'user',
                'description' => 'Akses pengguna dasar',
            ]
        );

        // Assign all permissions to Super Admin
        $superAdminRole->permissions()->sync(Permission::all()->pluck('id'));

        // Assign basic permissions to Admin
        $adminPermissions = Permission::whereIn('slug', [
            'view-dashboard', 'view-users', 'create-users', 'edit-users', 
            'view-roles', 'view-permissions', 'view-activities'
        ])->pluck('id');
        $adminRole->permissions()->sync($adminPermissions);

        // Assign basic permissions to User
        $userPermissions = Permission::whereIn('slug', [
            'view-dashboard'
        ])->pluck('id');
        $userRole->permissions()->sync($userPermissions);

        // Create Default Super Admin User
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@sistem-inventaris.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@sistem-inventaris.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Assign Super Admin role
        $superAdmin->roles()->sync([$superAdminRole->id]);

        $this->command->info('Data manajemen pengguna berhasil di-seed!');
        $this->command->info('Super Admin dibuat: admin@sistem-inventaris.com / admin123');
    }
}
