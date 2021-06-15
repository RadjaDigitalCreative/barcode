<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class payment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i <= 20 ; $i++) {
            DB::table('payments')->insert([
                'name' => $faker->name,
                'jabatan' => $faker->state,
                'lokasi' => $faker->city,
                'total_payment' => $faker->latitude($min = -90, $max = 90),
                'status_payment' => '1'
            ]);
        }
    }
}
