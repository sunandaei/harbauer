<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UnderlyingAsset extends Eloquent
{
   protected $connection = 'mongodb';
   protected $collection = 'underlyingAssets';

    protected $dates = array('expiryDate','dataCreatedDate');
    protected $fillable = [
        // Add other fillable fields here
        'insert_status',
        // ...
    ];
}
