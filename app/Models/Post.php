<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{

    // 新規投稿時に登録されるカラム内容
    protected $fillable = ['user_name','contents',];
}
