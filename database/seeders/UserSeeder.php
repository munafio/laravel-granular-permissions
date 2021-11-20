<?php

namespace Database\Seeders;

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
        $users = [
            [
                "name" => "Munafio",
                "email" => "info@munafio.com",
                "password" => "11223344",
            ],
            [
                "name" => "Ahmed",
                "email" => "ahmed@email.com",
                "password" => "11223344",
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
