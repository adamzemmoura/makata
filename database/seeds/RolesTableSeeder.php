<?php

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Carbon\Carbon;
=======
>>>>>>> be3381b32478dd2ee5fe0f1607e974b719d1f4a5

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
<<<<<<< HEAD

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
=======
        
        DB::table('roles')->insert([
            'name' => 'admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'user'
        ]);
    }
}
>>>>>>> be3381b32478dd2ee5fe0f1607e974b719d1f4a5
