<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memapp extends Model
{
    
    protected $connection="pgsql";

    protected $table="app.req_newmem";

    protected $fillable = ['answer', 'answer_ts'];

    protected $primaryKey = 'req_id';
    
    public $timestamps = false;

}
