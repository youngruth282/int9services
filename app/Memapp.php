<?php
/*
CREATE TABLE "app"."req_newmem" (
"req_id" serial,
"tid" int4,
"team_name" varchar(50),
"leader_name" varchar(20),
"newmem_name" varchar(20),
"newmem_email" varchar(50),
"created_ts" timestamp(6) DEFAULT now(),
"answer" varchar(2),
"answer_ts" timestamp(6),
"mlid" int4,
"leader_email" varchar(50),
"pid" int4,
PRIMARY KEY ("req_id")
)
WITH (OIDS=FALSE)
;
*/
namespace App;

use Illuminate\Database\Eloquent\Model;

class Memapp extends Model
{
    
    protected $connection="pgsql";

    protected $table="app.req_newmem";

    protected $fillable = ['answer', 'answer_ts', 'pid'];

    protected $primaryKey = 'req_id';
    
    public $timestamps = false;

}
