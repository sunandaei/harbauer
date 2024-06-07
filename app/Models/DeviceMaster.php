<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class DeviceMaster extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'deviceMaster';
    
}
