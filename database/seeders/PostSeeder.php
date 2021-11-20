<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {
            \App\Models\Post::create([
                "title" => $faker->text(50),
                "description" => $faker->realText(300),
                "user_id" => rand(1,2)
            ]);
        }

    }
}
