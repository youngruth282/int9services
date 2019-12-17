<?php
// 檢查課程是否可以報名
// tran_deadline AS enrollment_end 報名截止日期
namespace App;

use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    
    protected $connection="pgsql";

    protected $table="equip.view_equip_post";

    protected $fillable = [];

}
