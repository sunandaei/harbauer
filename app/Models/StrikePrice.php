<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class StrikePrice extends Eloquent
{
   protected $connection = 'mongodb';
   protected $collection = 'strikePrices';

    protected $dates = array('expiryDate','dataCreatedDate','dataCreatedTime');
    protected $fillable = [
        // Add other fillable fields here
        'insert_status',
        'underlying',
        'underlyingValue',
        'dataCreatedDate',
        'dataCreatedTime',
        'dataCreatedDay',
        'dataCreatedMonth',
        'dataCreatedYear',
        'strikePrice',
        
    ];
}
