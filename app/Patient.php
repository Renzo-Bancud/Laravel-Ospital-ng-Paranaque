<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table='patients';

    protected $fillable = [
        'upload_request', 'upload_id', 'firstname', 'lastname', 'address', 'bday','age', 'gender', 'fund_type','patient_ticket','patient_signature'
    ];

    public $timestamps = true;
}
