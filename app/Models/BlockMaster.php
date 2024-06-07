<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class BlockMaster extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'blockMaster';
    protected $fillable = ['dist_code', 'block_code','block_name']; // Add other fields as needed
}
