<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryCategory extends Model
{
    protected $table='laboratory_categories';

    protected $fillable = [
        'name'
    ];

    public $timestamps = true;
}
