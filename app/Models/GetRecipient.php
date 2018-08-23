<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GetRecipient extends Model
{
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'recipient';

    protected $fillable = [
        'name', 'email','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
