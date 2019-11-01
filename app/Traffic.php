<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    protected $table = 'traffic';
    public $timestamps = false;
    public function getViewerMonth(){
        $month = $this->whereRaw("MONTH(NOW())=MONTH(updated_at) AND YEAR(NOW())=YEAR(updated_at)")->sum('view_count');
        $premonth = $this->whereRaw("MONTH(ADDDATE(NOW(),INTERVAL -1 MONTH))=MONTH(updated_at) AND YEAR(NOW())=YEAR(updated_at)")->sum('view_count');
        return ['count'=>$month,'percent'=>$premonth!=0 ?ceil($month/$premonth*100) : 100];
    }
}
