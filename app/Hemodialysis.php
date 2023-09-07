<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hemodialysis extends Model
{
    protected $table='hemodialysis';

    protected $fillable = [
        'test', 'category_id','amount'
    ];

    public $timestamps = true;
}
