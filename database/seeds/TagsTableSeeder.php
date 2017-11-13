<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        
        $faker = Faker\Factory::create();

        foreach(range(1, 100) as $index) {
            DB::table('tags')->insert([
                'name' => $faker->word,
                'imagePath' => $faker->word.'/'.$faker->word,
                'created_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}
