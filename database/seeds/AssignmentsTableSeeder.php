<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('assignments')->insert([
            'working_day_id' => 26,
            'customer_id' => 111,
            'start_at' => Carbon::yesterday(),
            'job_id' => 1,
            'confirmed' => 0
        ]);

        DB::table('assignments')->insert([
            'working_day_id' => 26,
            'customer_id' => 111,
            'start_at' => Carbon::yesterday(),
            'job_id' => 1,
            'confirmed' => 1
        ]);
    }
}
