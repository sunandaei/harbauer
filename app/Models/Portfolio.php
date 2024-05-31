<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Portfolio extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'portfolios'; // Update with your desired collection name

    protected $fillable = [
        // Define your fillable attributes here
        'name', 'type','interval','remarks','status','active'
    ];

    public function positions()
    {
       return $this->hasMany(Position::class); //Laravel's Eloquent expects the foreign key to be named portfolio_id 
       


       //return $this->hasMany(Position::class, 'portfolioId', '_id');
    }
}
