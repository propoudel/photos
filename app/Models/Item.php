<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    public function price()
    {
        return $this->hasMany('App\Models\Price');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function publisher()
    {
        return $this->belongsTo('App\Models\Publisher');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }

    public function file_type()
    {
        return $this->belongsTo('App\Models\FileType');
    }

    public function media_type()
    {
        return $this->belongsTo('App\Models\MediaType');
    }

    public function Orientation()
    {
        return $this->belongsTo('App\Models\Orientation');
    }


    public function sizes(){
        return $this->hasMany('App\Models\Size');
    }

}


