<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GetSpecialOffer extends Model
{
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'special_offer';

    protected $fillable = [
        'recipientID', 'percentageDiscount','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
