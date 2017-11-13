<?php

use Illuminate\Database\Seeder;

class SongTagTableSeeder extends Seeder
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

        foreach(range(1, 500) as $index) {
            DB::table('song_tag_pivot')->insert([
                'songID' => $faker->numberBetween($min = 1, $max = 100),
                'tagID' => $faker->numberBetween($min = 1, $max = 100),
            ]);
        }
    }
}
