<?php

use Illuminate\Database\Seeder;
use App\Models\Staff;

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
        Staff::truncate();

        $faker = \Faker\Factory::create();
    
		for ($i = 0; $i < 10; $i++) {
            Staff::create([
                'name' => $faker->name(),
                'surname' => $faker->lastname(),
                'patrname' => $faker->name(),
                'position' => $faker->jobTitle()
            ]);
        }
    }
}
