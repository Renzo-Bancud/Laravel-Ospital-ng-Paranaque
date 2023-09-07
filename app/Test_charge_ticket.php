<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_charge_ticket extends Model
{
    protected $table='test_charge_tickets';

    protected $fillable = [
        'ticket_number','dept_id','item_id','qty','amount', 'ticket_status'
    ];

    public $timestamps = true;
}
