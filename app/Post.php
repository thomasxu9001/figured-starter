<?php

namespace App;

use Moloquent;
use DB;

class Post extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'posts';
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = '_id';
    protected $fillable = ['title', 'content'];
}
