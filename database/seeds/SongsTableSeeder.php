<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SongsTableSeeder extends Seeder
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

        // faker doesn't have a tempo field, so we'll use this array
        $tempo = ['Larghissimo','Adagissimo','Sostenuto','Grave','Largo','Lento','Larghetto','Adagio','Adagietto','Andante','Andantino','Marcia moderato','Andante moderato','Moderato','Allegretto','Allegro moderato','Allegro','Animato','Agitato','Veloce','Mosso Vivo','Vivace','Allegrissimo or Allegro vivace','Presto','Prestissimo','Vivacissimo'];

        foreach(range(1, 100) as $index) {
            shuffle($tempo);
            DB::table('songs')->insert([
                'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
                'length' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 10),
                'tempo' => $tempo[0],
                'path' => 'path',
                'created_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}
