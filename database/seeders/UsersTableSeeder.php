<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'phone' =>'0123523641',
                'birth_date' =>'2000-01-24',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'phone' =>'0123523641',
                'birth_date' =>'2000-01-24',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'User2',
                'email' => 'user2@user.com',
                'phone' =>'0123523641',
                'birth_date' =>'2000-01-24',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
        ];

        User::insert($users);
    }
}
