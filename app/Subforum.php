<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Subforum extends Model
{
    protected $guarded=['id'];

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderByDesc('updated_at');
    }

    public static function getParent($level)
    {
        return Subforum::all()->where('parent_id', Subforum::getByLevel($level))->first();
    }

    public static function getParents($id)
    {
        $data=array();
        $level=Subforum::getById($id)->level;
        while($level>0)
        {
            $subforum=Subforum::getById($id);
            $id=$subforum->parent_id;

            array_unshift($data, $subforum);
            $level--;
        }
        return new Collection($data);
    }

    public function getChilds()
    {
        $data=Subforum::all()->where('parent_id', $this->id);
        return new Collection($data);
    }

    public static function getById($id)
    {
        return Subforum::all()->where('id', $id)->first();
    }

    public static function getByLevel($level)
    {
        return Subforum::all()->where('level', $level)->first();
    }
}
