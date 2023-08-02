<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'role' => 'admin',
                'password' => bcrypt('admin'),
                'is_active' => true,
            ],
            [
                'name' => 'Student',
                'username' => 'student',
                'role' => 'student',
                'password' => bcrypt('student'),
                'is_active' => true,
            ]
        ]);
    }
}
