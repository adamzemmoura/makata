<?php

use Illuminate\Database\Seeder;

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

        // faker doesn't have a tempo field, so we'll use this array
        $tempo = ['Larghissimo','Adagissimo','Sostenuto','Grave','Largo','Lento','Larghetto','Adagio','Adagietto','Andante','Andantino','Marcia moderato','Andante moderato','Moderato','Allegretto','Allegro moderato','Allegro','Animato','Agitato','Veloce','Mosso Vivo','Vivace','Allegrissimo or Allegro vivace','Presto','Prestissimo','Vivacissimo'];

        foreach(range(1, 100) as $index) {
            shuffle($tempo);
            DB::table('songs')->insert([
                'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
                'length' => $faker->time($format = 'i:s'),
                'tempo' => $tempo[0],
            ]);
        }
    }
}
