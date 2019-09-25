<?php
//每周主日崇拜經文

namespace App;

use Illuminate\Database\Eloquent\Model;

class MD_WACont extends Model
{
    protected $connection="pgsql_webdb";

    protected $table="wacontent";

    protected $fillable = [];

    public function watype()
    {
        return $this->belongsTo('App\MD_WAType', 'wcode', 'wcode');
    }

}
