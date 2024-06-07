<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class PanMaster extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'panMaster';
    protected $fillable = ['dist_code', 'block_code','pan_code','pan_name']; // Add other fields as needed
}
