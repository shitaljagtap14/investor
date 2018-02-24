<?php

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
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
                'first_name' => 'Ms',
                'last_name' => 'Admin',
                'name' => 'admin',
                'is_admin' => TRUE,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),

            ],
            [
                'first_name' => 'Mr',
                'last_name' => 'User',
                'name' => 'user',
                'is_admin' => FALSE,
                'email' => 'user@gmail.com',
                'password' => Hash::make('user123'),

            ],
            [
                'first_name' => 'Mr',
                'last_name' => 'Sandeep',
                'name' => 'Mr Sandeep',
                'is_admin' => TRUE,
                'email' => 'sandeep@gmail.com',
                'password' => Hash::make('sorry123'),

            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
