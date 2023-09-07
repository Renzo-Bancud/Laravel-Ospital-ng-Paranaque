<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadiologyCategory extends Model
{
    protected $table='radiology_categories';

    protected $fillable = [
        'name'
    ];

    public $timestamps = true;
}
