<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Result extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'result'; // Update with your desired collection name

    protected $fillable = [
    'dist_code', 'dist_name','block_code','block_name','pan_code','pan_name','ward_code','ward','scheme_name','scheme_id','scheme_type','device_code','device_id','status'
    ];

}
