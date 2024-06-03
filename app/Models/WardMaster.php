<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class WardMaster extends Eloquent
{
    protected $collection = 'wardMaster';
    protected $fillable = ['pan_code', 'ward_code','WARD']; // Add other fields as needed
}
