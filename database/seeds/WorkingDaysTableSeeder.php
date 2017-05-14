<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class WorkingDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 2)->get();
        $now = Carbon::now();
        $date = Carbon::createFromDate(intval($now->format('Y')), intval($now->format('m')), intval($now->format('d')));
        $date_from = clone $date;
        $date_to = clone $date;
        $date_from->addHours(19);
        $date_to->addHours(27);
        for ($i=0; $i<14; $i++) {
            $dateFrom = $date_from->toDateTimeString();
            $dateTo = $date_to->toDateTimeString();
            foreach ($users as $user) {
                  DB::table('working_days')->insert([
                    'user_id' => $user->id,
                    'from' => $date_from,
                    'until' => $date_to,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
        $date_from->addHours(24);
        $date_to->addHours(24);
        }

    }
}
