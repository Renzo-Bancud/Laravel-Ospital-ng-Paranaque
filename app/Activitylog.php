<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitylog extends Model
{
    protected $table='activitylogs';

    protected $fillable = [
        'user_id','user_type','activity_type', 'ip_address', 'device_info','details', 'status'
    ];

    public $timestamps = true;
}
