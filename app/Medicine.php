<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pharma_id','category_id','brand_number','registration_number','purchase_price','sale_price','quantity','company','expire_date'
    ];



  
}
