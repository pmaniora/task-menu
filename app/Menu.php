<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * @var array
     */
    protected $attributes = [
        'field' => true,
    ];

    public function items()
    {
        return $this->hasMany('App\Item','menu');
    }
}
