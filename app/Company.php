<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use test\Mockery\ReturnTypeObjectTypeHint;

class Company extends Model
{
    protected $guarded=[];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
