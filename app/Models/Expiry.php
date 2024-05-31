<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Expiry extends Eloquent
{
   protected $connection = 'mongodb';
   protected $collection = 'expiries';

    protected $dates = array('expiryDate','dataCreatedDate');
    protected $fillable = [
        // Add other fillable fields here
        'expiryDate',
        // ...
    ];
}
