<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class usersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rand = rand(10000,200000);
        DB::table('users')->insert([
            'email' => Str::random(10).'@gmail.com',
            'password' =>bcrypt('vucms')
        ]);
    }
}
