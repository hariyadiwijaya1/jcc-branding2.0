<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
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

        $faker = Factory::create();
        for ($i = 0; $i < 30; $i++) {
            $admin = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('password'),
            ]);
        }

        $admin->assignRole('Admin');
        $superadmin->assignRole('Superadmin');
    }
}
