<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class OptionChainCurrent extends Eloquent
{
   protected $connection = 'mongodb';
   protected $collection = 'optionChainCurrents';

    protected $dates = array('expiryDate','dataCreatedDate');
    protected $fillable = [
        // Add other fillable fields here
        'insert_status',
        // ...
    ];
   
}
