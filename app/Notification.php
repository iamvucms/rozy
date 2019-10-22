<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Notification extends Model
{
    protected $table = 'notifications';
    public $fillable = ['is_all','to','is_hidden'];
    public function Image()
    {
        return $this->hasOne('App\Image', 'id_notify', 'id')->first();
    }
}
