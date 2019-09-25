<?php
//聖經經文
namespace App;

use Illuminate\Database\Eloquent\Model;

class DB_CBible extends Model
{
    protected $connection="pgsql_pgdbs";

    protected $table="cbible";

    protected $fillable = [];

    public function BibleCode()
    {
        return $this->belongsTo('App\DB_BibleCode', 'bibleno', 'bibleno');
    }

    public function scopeSrchBible($query, $BNo, $Sch, $Snu, $Ech, $Enu)
    {
        // 多个or和and条件查询
        // https://upeng.github.io/blog/2017/09/14/laravel-eloquent-index/
        // https://iluoy.com/articles/67
        /*
        $id = 2;
        $market->where( {
        Users::where(function($q){
            $q->where('id', $id)
            ->orWhere('name', 'taylor')
            ->orWhere('age', 27)
        })->where('address', 'shanghai');


        $query = " where BibleNo='$BNo'";
	
        if ($Sch == $Ech) {
            $query.= " and Chapter=$Sch and Number between $Snu and $Enu";
        } elseif ($Ech-$Sch == 1) {
            $query.= " and ((Chapter=$Sch and Number>=$Snu";
            $query.= ") or (Chapter=$Ech and Number<=$Enu))";
        } else {
            $query.= " and ((Chapter=$Sch and Number>=$Snu";
            $query.= ") or (Chapter=$Ech and Number<=$Enu)";
            $query.= " or Chapter between ".($Sch+1)." and ".($Ech-1).")";
        }
        $query.= " order by Chapter,Number";
        return $query->selectRaw('ctext')->where('BibleNo', $BNo );
*/

        if ($Sch == $Ech) {
            return $query->where(['bibleno' => $BNo, 'chapter' => $Sch])->whereBetween('number', [$Snu, $Enu]);
        } elseif ($Ech-$Sch == 1) {
            return $query->selectRaw('ctext')->where(function ($query, $Sch, $Snu, $Ech, $Enu){
                $query->where(['chapter'=>$Sch, 'number >=' => $Snu])
                ->orwhere(['chapter'=>$Ech, 'number <=' => $Enu]);
            })->where('bibleno', $BNo)->orderBy(['chapter','number']);
        } else {
            return $query->selectRaw('ctext')->where(function ($query, $Sch, $Snu, $Ech, $Enu){
                $query->where(['chapter'=>$Sch, 'number >=' => $Snu])
                ->orwhere(['chapter'=>$Ech, 'number <=' => $Enu])
                ->orwhereBetween('number', [$Snu, $Enu]);
            })->where('bibleno', $BNo)->orderBy(['chapter','number']);

        }
    }

}
