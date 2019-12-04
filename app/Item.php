<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * @var array
     */
    protected $attributes = [
        'field' => true,
    ];

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }

    public function parent()
    {
        return $this->belongsTo('App\Item');
    }

    public function children()
    {
        return $this->hasMany('App\Item', 'parent');
    }
}
