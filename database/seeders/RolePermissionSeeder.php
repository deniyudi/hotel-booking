<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ======== untuk mendefinisikan butuh permission apa aja pada program kita
        $permissions = [
            'manage countries',
            'manage cities',
            'manage hotels',
            'manage hotel bookings',
            'manage hotel facilities',
            'checkout hotels',
            'view hotel bookings',
        ];

        // ======= simpan ke database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }


        // bikin role setelah bikin permission

        //======== ROLE CUSTOMER ========
        $customerRole = Role::firstOrCreate([
            'name' => 'customer'
        ]);

        // permision customer apa aja
        $customerPermissions = [
            'checkout hotels',
            'view hotel bookings',
        ];

        //  perlu di sync agar spatie deteksi hal tersebut
        $customerRole->syncPermissions($customerPermissions);

        // ========== ROLE SUPER ADMIN =========
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        // ketika udah memiliki role admin maka bikin akunnya
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'avatar' => 'https://images.unsplash.com/photo-1640951613773-54706e06851d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fHVzZXJ8ZW58MHx8MHx8fDA%3D',
            'password' => bcrypt('password'),
        ]);

        // bikin role super admin (wajib) assign ketika role sudah dibuat
        $user->assignRole($superAdminRole);
    }
}
