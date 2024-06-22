<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'     => 'Amzar',
            'email'    => 'amzarayisy1812@gmail.com',
            'password' => bcrypt('1sampai9'),
        ]);

        $admin->assignRole('admin');

        $teacher = User::create([
            'name'     => 'Nadira',
            'email'    => 'nadirahuda26@gmail.com',
            'password' => bcrypt('Nh865423_'),
        ]);

        $teacher->assignRole('teacher');
    }
}
