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
            'email' => 'superadmin@example.com',
            'avatar' => 'images/dummy.png',
            'password' => bcrypt('password'),
        ]);

        // bikin role super admin (wajib) assign ketika role sudah dibuat
        $user->assignRole($superAdminRole);
    }
}
