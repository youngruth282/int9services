<?php
//收費課程
namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $connection="pgsql";

    protected $table="equip.view_post_courses";

    protected $fillable = [];

}
