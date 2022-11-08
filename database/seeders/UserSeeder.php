<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@role.test',
            'password' => bcrypt('admin'),
        ]);

        $admin = User::create([
            'name' => 'Admin Biasa',
            'email' => 'admin@role.test',
            'password' => bcrypt('admin'),
        ]);

        $admin->assignRole('Admin');
        $superadmin->assignRole('Superadmin');
    }
}
