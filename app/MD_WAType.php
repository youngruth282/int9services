<?php
//每周主日崇拜

namespace App;

use Illuminate\Database\Eloquent\Model;

class MD_WAType extends Model
{
    protected $connection="pgsql_webdb";

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
}
