<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            'name' => 'PRANJE',
            'description' => 'Pranje svih vrsta kose (m/ž).',
            'price' => 20,
            'duration_in_minutes' => 15
        ]);

        DB::table('jobs')->insert([
            'name' => 'PODREZIVANJE ŠIŠKI',
            'description' => 'Za muškarce i žene.',
            'price' => 20,
            'duration_in_minutes' => 15
        ]);

        DB::table('jobs')->insert([
            'name' => 'ŠIŠANJE(M)',
            'description' => 'Šišanje kratkih do srednje dugih muških frizura.',
            'price' => 35,
            'duration_in_minutes' => 15
        ]);
        DB::table('jobs')->insert([
            'name' => 'ŠIŠANJE-DUGA(M)',
            'description' => 'Šišanje dugih muških frizura.',
            'price' => 70 ,
            'duration_in_minutes' => 30
        ]);

        DB::table('jobs')->insert([
            'name' => 'ŠIŠANJE-KRATKO(Ž)',
            'description' => 'Šišanje kratkih ženskih frizura',
            'price' => 70,
            'duration_in_minutes' => 15
        ]);
        DB::table('jobs')->insert([
            'name' => 'ŠIŠANJE-SREDNJE(Ž)',
            'description' => 'Šišanje srednje dugih ženskih frizura',
            'price' => 90,
            'duration_in_minutes' => 30
        ]);
        DB::table('jobs')->insert([
            'name' => 'ŠIŠANJE-DUGO(Ž)',
            'description' => 'Šišanje dugih ženskih frizura',
            'price' => 110,
            'duration_in_minutes' => 45
        ]);
        DB::table('jobs')->insert([
            'name' => 'PEGLANJE KOSE',
            'description' => 'Peglanje svih vrsta kose.',
            'price' => 50,
            'duration_in_minutes' => 15
        ]);
        DB::table('jobs')->insert([
            'name' => 'BOJANJE-KRATKA(Ž)',
            'description' => 'Bojanje kratkih ženskih frizura',
            'price' => 70,
            'duration_in_minutes' => 30
        ]);
        DB::table('jobs')->insert([
            'name' => 'BOJANJE-SREDNJE(Ž)',
            'description' => 'Bojanje srednje dugih ženskih frizura',
            'price' => 100,
            'duration_in_minutes' => 30
        ]);
        DB::table('jobs')->insert([
            'name' => 'BOJANJE-DUGA(Ž)',
            'description' => 'Bojanje dugih ženskih frizura',
            'price' => 140,
            'duration_in_minutes' => 45
        ]);
        DB::table('jobs')->insert([
            'name' => 'SVEČANA FRIZURA',
            'description' => 'Posebna ponuda, uključuje pranje, peglanje, šišanje i bojanje kose.',
            'price' => 300,
            'duration_in_minutes' => 45
        ]);
    }
}
