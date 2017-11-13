<?php

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Carbon\Carbon;
=======
>>>>>>> be3381b32478dd2ee5fe0f1607e974b719d1f4a5

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

<<<<<<< HEAD
        $faker = Faker\Factory::create();

=======
>>>>>>> be3381b32478dd2ee5fe0f1607e974b719d1f4a5
        // faker doesn't have a tempo field, so we'll use this array
        $tempo = ['Larghissimo','Adagissimo','Sostenuto','Grave','Largo','Lento','Larghetto','Adagio','Adagietto','Andante','Andantino','Marcia moderato','Andante moderato','Moderato','Allegretto','Allegro moderato','Allegro','Animato','Agitato','Veloce','Mosso Vivo','Vivace','Allegrissimo or Allegro vivace','Presto','Prestissimo','Vivacissimo'];

        foreach(range(1, 100) as $index) {
            shuffle($tempo);
            DB::table('songs')->insert([
                'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
<<<<<<< HEAD
                'length' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 10),
                'tempo' => $tempo[0],
                'path' => 'path',
                'created_at' => $faker->dateTime($max = 'now'),
=======
                'length' => $faker->time($format = 'i:s'),
                'tempo' => $tempo[0],
>>>>>>> be3381b32478dd2ee5fe0f1607e974b719d1f4a5
            ]);
        }
    }
}
