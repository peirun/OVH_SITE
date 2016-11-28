<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Tag;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
