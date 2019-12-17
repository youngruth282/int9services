<?php
// 小組材料
// select distinct A.WNo,A.WDate,A.WTitle,A.WAuther,B.WName,B.WCode from WAType B 
// left join WActivity A on A.WNo=B.WNo where B.WCode ='W2' and date_part('year', 
// age('now',A.WDate)) =0 and date_part('month',age('now',A.WDate)) between 0 and 3 order by A.WDate desc

namespace App;

use Illuminate\Database\Eloquent\Model;

class MD_CellDocs extends Model
{
    protected $connection="pgsql_webdb";

    // protected $table="view_celldocs";
    protected $table="view_services_celldocs";//多了 A.wid, A.wdoc

    protected $fillable = [];

    // public function scopeViewInfo($query)
    // {
    //         return $query->leftJoin('wactivity', 'wactivity.wno','watype.wno')
    //         ->selectRaw('distinct wactivity.wno,wactivity.wdate,wactivity.wtitle,wactivity.wauther,watype.wname,watype.wcode')->where("watype.wcode ='W2' and date_part('year',age('now',wactivity.wdate)) =0 and date_part('month',age('now',wactivity.wdate)) between 0 and 3")->orderBy('wactivity.wdate', 'desc');
    // }
    // public function scopeViewInfo($query)
    // {
    //         return $query->leftJoin('WActivity', 'WActivity.wno','watype.wno')->selectRaw('distinct WActivity.WNo,WActivity.WDate,WActivity.WTitle,WActivity.WAuther,watype.WName,watype.WCode')->where('rooms.deleted_at', NULL );
    // }
    // public function WActivity()
    // {
    //     return $this->belongsTo('App\DB_WActivity', 'wdate', 'wdate');
    // }

}
