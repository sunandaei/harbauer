<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Position extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'positions'; // 

    protected $fillable = [
        'script',
        'segment',
        'expiry',
        'price',
        'action',
        'option',
        'strickOption', 
        'note',
        'portfolio_id',
        'entry_price',
        'exit_price',
        'current_price',

    ];
}
