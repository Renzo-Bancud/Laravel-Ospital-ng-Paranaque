<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $table='laboratories';

    protected $fillable = [
        'test', 'category_id','amount'
    ];

    public $timestamps = true;
}
