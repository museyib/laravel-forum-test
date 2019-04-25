<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded=[];

    public function topic()
    {
        return $this->belongsTo(Topic::class)->get()->first();
    }

    public function user()
    {
        return User::all()->where('id', $this->user_id)->first();
    }

    public static function getById($id)
    {
        return Post::where('id', $id)->get()->first();
    }

    public function link()
    {

    }
}
