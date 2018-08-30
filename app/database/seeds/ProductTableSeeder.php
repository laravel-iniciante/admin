<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductTableSeeder extends Seeder
{
    public function run()
    {
        /**
         * We are going to insert 500 products.
         */
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 500; $i++) {
            DB::table('products')->insert([
                'name' => implode($faker->words(),' '),
                'description' => $faker->paragraph(),
                'price' => $this->mt_rand_float(0, 100),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
    //Thanks to: http://stackoverflow.com/a/38691102/867418
    private function mt_rand_float($min, $max, $countZero = '0')
    {
        $countZero = +('1' . $countZero);
        $min = floor($min * $countZero);
        $max = floor($max * $countZero);
        $rand = mt_rand($min, $max) / $countZero;
        return $rand;
    }
}
