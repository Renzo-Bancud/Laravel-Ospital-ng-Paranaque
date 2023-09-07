<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radiology extends Model
{
    protected $table='radiologies';

    protected $fillable = [
        'test', 'category_id','amount'
    ];

    public $timestamps = true;
}
