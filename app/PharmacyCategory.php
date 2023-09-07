<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacyCategory extends Model
{
    protected $table='pharmacy_categories';

    protected $fillable = [
        'name'
    ];

    public $timestamps = true;
}
