<?php

namespace App;

use Moloquent;
use DB;

class Post extends Moloquent
{
    protected $connection = 'mongodb';  //库名
    protected $collection = 'posts';     //文档名
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = '_id';    //设置id
    protected $fillable = ['title', 'content'];  //设置字段白名单
}
