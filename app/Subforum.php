<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($parent_id)
 * @method static where(string $string, $id)
 * @property mixed parent_id
 * @property mixed id
 * @property mixed level
 * @property mixed name
 */
class Subforum extends Model
{
    protected $guarded=['id'];

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderByDesc('updated_at');
    }

    public function parent()
    {
        return Subforum::find($this->parent_id);
    }

    public function parents()
    {
        $id=$this->id;
        $data=array();
        $level=$this->level;
        while($level>0)
        {
            $subforum=Subforum::find($id);
            $id=$subforum->parent_id;

            array_unshift($data, $subforum);
            $level--;
        }
        return new Collection($data);
    }

    public function childs()
    {
        $data=Subforum::where('parent_id', $this->id)->get();
        return new Collection($data);
    }
}
