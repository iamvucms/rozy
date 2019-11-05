<?php

namespace App;
use Illuminate\Support\Facades\Auth;
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
    public function getTotalView(){
        return $this->sum('view_count');
    }
    public function getSessionLoginCount(){
        return $this->selectRaw('sum(login_count) as sum')
        ->first()->sum ?? 0;
    }
    public function getNewSessionLoginCount(){
        $count = $this->selectRaw('sum(login_count) as sum') 
        ->whereRaw('DAY(NOW())=DAY(updated_at) AND MONTH(NOW())=MONTH(updated_at) AND YEAR(NOW())=YEAR(updated_at)')
        ->first()->sum;
        $precount = $this->selectRaw('sum(login_count) as sum') 
        ->whereRaw('DAY(ADDDATE(NOW(),INTERVAL -1 DAY))=DAY(updated_at) AND MONTH(NOW())=MONTH(updated_at) AND YEAR(NOW())=YEAR(updated_at)')
        ->first()->sum;
        return ['count'=>$count,'percent'=>$precount!=0 ?ceil($count/$precount*100) : 100];
    }
    public function getAvgTimeSession(){
        return $this->sum('logout_count')!=0 ? round($this->sum('time')/ $this->sum('logout_count')) : '0';
    }
    public function getCountLogout(){
        return $this->sum('logout_count');
    }
    public function getViewEachDay($month=1){
        $viewChart = collect();
        $days = cal_days_in_month(CAL_GREGORIAN,date($month),date('Y'));
        $views = $this->selectRaw('view_count as view,DAY(updated_at) as day')->whereRaw('MONTH(updated_at) ='.$month)->get();
        for($i=1;$i<=$days;$i++){
            $check = true;
            foreach($views as $view){
                if($view->day == $i){
                    $check = false;
                    $viewChart->push(['view'=>$view->view,'day'=>$view->day]);
                    goto out;
                }
            }
            out:
            if($check){
                $viewChart->push(['view'=>0,'day'=>$i]);
            }
        }
        return $viewChart->toJson(JSON_HEX_APOS);
    }
}
