<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 // Удалим имеющиеся в таблице данные
        Article::truncate();

        $faker = \Faker\Factory::create();
    
		for ($i = 0; $i < 10; $i++) {
            Article::create([
                'name' => $faker->name(),
                'surname' => $faker->lastname(),
                'patrname' => $faker->name(),
                'position' => $faker->jobTitle()
            ]);
        }
    }
}
