<?php
//每日讀經經文，尚未使用
namespace App;

use Illuminate\Database\Eloquent\Model;

class DB_DBible extends Model
{
    protected $connection="pgsql_pgdbs";

    protected $table="dbible";

    protected $fillable = [];

    public function BibleCode()
    {
        return $this->belongsTo('App\DB_BibleCode', 'bibleno', 'bibleno');
    }

}
