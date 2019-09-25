<?php
// 每周主日崇拜資料

namespace App;

use Illuminate\Database\Eloquent\Model;

class MD_WActiv extends Model
{
    protected $connection="pgsql_webdb";

    protected $table="wactivity";

    protected $fillable = [];

    public function watype()
    {
        return $this->belongsTo('App\MD_WAType', 'wno', 'wno');
    }

}
