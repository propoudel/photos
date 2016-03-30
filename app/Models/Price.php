<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table ="prices";

    public function size()
    {
        return $this->belongsTo('App\Models\Size','size_id');
    }

    public function file()
    {
        return $this->belongsTo('App\Models\ItemFile');
    }
}
