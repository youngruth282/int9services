<?php
// 檢查人員是否為註冊會友
// SELECT member.pid, member.per_email, "substring"((member.per_no)::text, 7, 4) AS id4 FROM member.member WHERE (("substring"((member.per_no)::text, 7, 4) <> ''::text) AND ((member.per_email)::text <> ''::text)) ORDER BY member.pid;
namespace App;

use Illuminate\Database\Eloquent\Model;

class EqCheck extends Model
{
    
    protected $connection="pgsql";

    protected $table='public.v_eqcheck_member';//"member.member";//llcdb.mem_person 可考慮此view

    protected $fillable = [];

}
