<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
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
        
        DB::table('roles')->insert([
            'name' => 'admin',
            'created_at' => $faker->dateTime($max = 'now'),
        ]);

        DB::table('roles')->insert([
            'name' => 'user',
            'created_at' => $faker->dateTime($max = 'now'),
        ]);
    }
}
