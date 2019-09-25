<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemTeamLogin extends Model
{
    
    protected $connection="pgsql";

    protected $table="member.team_login";

    protected $fillable = [];

}
