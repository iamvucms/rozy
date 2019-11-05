<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';
    public function Communes()
    {
        return $this->hasMany('App\Commune', 'district_id', 'id');
    }
}
