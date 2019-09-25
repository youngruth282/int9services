<?php
// SELECT member.pid, member.per_email, "substring"((member.per_no)::text, 7, 4) AS id4 FROM member.member ORDER BY member.pid;
namespace App;

use Illuminate\Database\Eloquent\Model;

class MemCheck extends Model
{
    
    protected $connection="pgsql";

    protected $table='public.v_memapp_member';//"member.member";//llcdb.mem_person 可考慮此view

    protected $fillable = [];

}
