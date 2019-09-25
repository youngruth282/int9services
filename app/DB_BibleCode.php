<?php
//聖經卷名
namespace App;

use Illuminate\Database\Eloquent\Model;

class DB_BibleCode extends Model
{
    protected $connection="pgsql_pgdbs";

    protected $table="biblecode";

    protected $fillable = [];

    public function cbible()
    {
        return $this->hasMany('App\DB_CBible', 'bibleno', 'bibleno');
    }
    public function dbible()
    {
        return $this->hasMany('App\DB_DBible', 'bibleno', 'bibleno');
    }
}
