<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

/**
 * @method static create($validate)
 * @property mixed name
 */
class Role extends EntrustRole
{
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
