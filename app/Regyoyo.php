<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regyoyo extends Model
{
    
    protected $connection="pgsql";

    protected $table="equip.reg_yoyo";
    
    protected $primaryKey = 'y_id';

    protected $fillable = ["y_tran_cid", "y_pid"];

    public $timestamps = false;
}
