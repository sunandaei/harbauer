<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Segment extends Eloquent
{
   protected $connection = 'mongodb';
   protected $collection = 'segments';

    protected $dates = array('expiryDate','dataCreatedDate');
    protected $fillable = [
        // Add other fillable fields here
        'insert_status',
        // ...
    ];
}
