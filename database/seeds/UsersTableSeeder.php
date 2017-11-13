<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
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

        // there's no industry on Faker, so we'll use this array to output a random value
        $industry = ['Education', 'Food', 'Entertainment', 'Transportation', 'Technology'];

        DB::table('users')->insert([
            'roleID' => '1',
            'name' => 'Makata',
            'email' => 'makata@g.harvard.edu',
            'company' => 'Harvard University',
            'industry' => 'Education',
            'password' => bcrypt('3bywzyI2szZnbna2uJoC'),
            'created_at' => $faker->dateTime($max = 'now'),
        ]);

        foreach(range(1, 30) as $index) {
            shuffle($industry);
            DB::table('users')->insert([
                'roleID' => '2',
                'name' => $faker->name,
                'email' => $faker->email,
                'company' => $faker->company,
                'industry' => $industry[0],
                'password' => bcrypt($faker->password),
                'created_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}
