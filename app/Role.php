<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $guarded=['id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
