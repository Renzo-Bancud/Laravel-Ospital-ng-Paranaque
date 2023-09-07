<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $table='pharmacies';

    protected $fillable = [
        'medicine', 'category_id','amount'
    ];

    public $timestamps = true;
}
