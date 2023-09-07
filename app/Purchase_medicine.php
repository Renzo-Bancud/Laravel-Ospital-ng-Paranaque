<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase_medicine extends Model
{
    protected $table='purchase_medicines';

    protected $fillable = [
        'medicine_id', 'patient_id', 'purchase_qty'
    ];

    public $timestamps = true;
}
