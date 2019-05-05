<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded=[];

    public function subforum()
    {
        return $this->belongsTo(Subforum::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('updated_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lastUser()
    {
        if ($this->posts()->get()->last()==null)
        {
            return $this->user();
        }
        return User::all()->where('id', $this->lastPost()->user_id)->first();
    }

    public function lastPost()
    {
        if ($this->posts()->get()->last()==null)
        {
            return $this;
        }
        return $this->posts()->get()->last();
    }
}
