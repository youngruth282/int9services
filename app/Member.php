<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    
    protected $connection="pgsql";

    protected $table="member.member";

    protected $guarded = [];

    protected $primaryKey = 'pid';
    
    public $timestamps = false;
}
