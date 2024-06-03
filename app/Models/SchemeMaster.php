<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class SchemeMaster extends Eloquent
{
    protected $collection = 'schemeMaster';
    protected $fillable = ['scheme_id', 'scheme_type','scheme_code','scheme_name']; // Add other fields as needed
}
