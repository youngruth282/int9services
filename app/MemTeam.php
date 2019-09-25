<?php
//select A.area_name, B.tid, B.team_name, B.team_no from llcdb.area A, llcdb.team B where substring(A.area_no,1,2)=substring(B.team_no,1,2) order by tid 
namespace App;

use Illuminate\Database\Eloquent\Model;

class MemTeam extends Model
{
    
    protected $connection="pgsql";

    protected $table="member.team_mem";//

    protected $fillable = ["mlid","pid"];

    protected $primaryKey = 'tmid';

    public $timestamps = false;

}
