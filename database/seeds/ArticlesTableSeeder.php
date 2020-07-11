<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 // Удалим имеющиеся в таблице данные

        $faker = \Faker\Factory::create();
    
		for ($i = 0; $i < 10; $i++) {
            Article::create([
                'title' => $faker->sentence(5),
                'category' => $faker->sentence(5),
                'imagepath' => $faker->sentence(5),
                'content' => $faker->text(200)
            ]);
        }


    }
}
