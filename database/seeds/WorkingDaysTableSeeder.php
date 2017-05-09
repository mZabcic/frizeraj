<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class WorkingDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $from = Carbon::now()->addHours(-2);
      $to = Carbon::addHours(6);
      $dateFrom = $from->toDateTimeString();
      $dateTo = $to->toDateTimeString();
      DB::table('working_days')->insert([
          'user_id' => 1,
          'from' => $dateFrom,
          'until' => $dateTo,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
      ]);
    }
}
