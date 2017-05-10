<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // Adding customers
    	foreach (range(1,100) as $index) {
            $splitted = explode(' ',trim($faker->name));
            $first_name = $splitted[0];
            $last_name = $splitted[1];
	        DB::table('users')->insert([
	            'first_name' => $first_name,
                'last_name' => $last_name,
	            'email' => $faker->email,
                'role' => 1,
	            'password' => bcrypt('secret'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ]);
        }
        // Adding hairdressers 
        foreach (range(1,5) as $index) {
            $splitted = explode(' ',trim($faker->name));
            $first_name = $splitted[0];
            $last_name = $splitted[1];
	        DB::table('users')->insert([
	            'first_name' => $first_name,
                'last_name' => $last_name,
	            'email' => $faker->email,
                'role' => 2,
	            'password' => bcrypt('secret'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ]);
        }
         // Adding admins 
           $splitted = explode(' ',trim($faker->name));
            $first_name = $splitted[0];
            $last_name = $splitted[1];
	        DB::table('users')->insert([
	            'first_name' => $first_name,
                'last_name' => $last_name,
	            'email' => 'admin@admin.hr',
                'role' => 3,
	            'password' => bcrypt('secret'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ]);

    }
}
