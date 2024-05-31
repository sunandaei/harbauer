<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Script extends Eloquent
{
   protected $connection = 'mongodb';
   protected $collection = 'scripts';

    protected $dates = array('expiryDate','dataCreatedDate');
    protected $fillable = [
        // Add other fillable fields here
        'insert_status',
        // ...
    ];
}
