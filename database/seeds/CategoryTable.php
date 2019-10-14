<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class CategoryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = Str::random(10);
        DB::table('categories')->insert([
            'icon' =>'fas fa-mobile-alt',
            'img'=>'assets/img/dodadung.png',
            'name' =>$str,
            'order' => '1',
            'slug' =>$str,
            'create_at' => date("Y-m-d H:i:s")
        ]);
    }
}
