<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded=[];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return User::all()->where('id', $this->user_id)->first();
    }
}
