<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BarcodeProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i <= 30 ; $i++) {
            DB::table('barcode_products')->insert([
                'item_id' => '1',
                'name' => $faker->word,
            ]);
        }
    }
}
