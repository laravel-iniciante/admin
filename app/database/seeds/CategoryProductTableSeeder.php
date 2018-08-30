<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = \App\Product::all();
        //Categories that don't have child categories.
        $categories = \App\Category::where('id', '!=', 'sub_category_id')->get();
        foreach ($products as $product) {
            DB::table('category_product')->insert([
                'category_id' => $categories->random()->id,
                'product_id' => $product->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
