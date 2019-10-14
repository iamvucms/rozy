<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class DiscountTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount')->insert([
            'idproduct' =>1,
            'percent'=>20,
            'from' =>'2019-09-09 00:00:00',
            'to' => '2019-12-12 00:00:00',
            'create_at' => date("Y-m-d H:i:s")
        ]);
    }
}
