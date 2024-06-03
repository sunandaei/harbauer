<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DistMaster extends Eloquent
{
    protected $collection = 'distMaster';
    protected $fillable = ['dist_code','dist_name']; // Add other fields as needed
}
