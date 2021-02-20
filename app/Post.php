<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed topic_id
 */
class Post extends Model
{
    protected $guarded=[];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function link()
    {

    }
}
