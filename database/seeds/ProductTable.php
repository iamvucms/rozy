<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rand = rand(10000,200000);
        DB::table('products')->insert([
            'name' => Str::random(10),
            'slug' =>Str::random(10),
            'price' =>$rand,
            'sale_price'=>$rand,
            'idcat' =>'5',
            'idsell'=>'5',
            'quantity' =>10,
            'city_address'=>'Hồ Chí Minh',
            'update_at' =>date("Y-m-d H:i:s"),
            'create_at' =>date("Y-m-d H:i:s")
        ]);
    }
}
