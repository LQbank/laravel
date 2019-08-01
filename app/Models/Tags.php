<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    // 设置模型表名
    public $table = 'tag';

    protected $fillable = ['name','cate_id'];
}
