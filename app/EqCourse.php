<?php
// 檢查重複的課程是否可以報名
// tran_deadline AS enrollment_end 報名截止日期
namespace App;

use Illuminate\Database\Eloquent\Model;

class EqCourse extends Model
{
    
    protected $connection="pgsql";

    protected $table="equip.view_post_courses";

    protected $fillable = [];

}
