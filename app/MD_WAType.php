<?php
//每周主日崇拜

namespace App;

use Illuminate\Database\Eloquent\Model;

class MD_WAType extends Model
{
    protected $connection="pgsql";

    protected $table="watype";

    protected $fillable = [];


    public function wactiv()
    {
        return $this->hasMany('App\MD_WActiv', 'wno', 'wno');
    }

    public function wacont()
    {
        return $this->hasMany('App\MD_WACont', 'wno', 'wno');
    }

    public function wabible()
    {
        return $this->hasMany('App\MD_WABible', 'wno', 'wno');
    }
    // public function scopeViewInfo($query)
    // {
    //         return $query->leftJoin('wactivity', 'wactivity.wno','watype.wno')
    //         ->selectRaw('distinct wactivity.wno,wactivity.wdate,wactivity.wtitle,wactivity.wauther,watype.wname,watype.wcode')->where("watype.wcode ='W2' and date_part('year',age('now',wactivity.wdate)) =0 and date_part('month',age('now',wactivity.wdate)) between 0 and 3")->orderBy('wactivity.wdate', 'desc');
    // }

    
}
