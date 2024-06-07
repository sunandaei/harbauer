<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class VillMaster extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'villMaster';   
}
