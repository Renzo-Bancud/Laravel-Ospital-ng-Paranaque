<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HemodialysisCategory extends Model
{
    protected $table='hemodialysis_categories';

    protected $fillable = [
        'name'
    ];

    public $timestamps = true;
}
