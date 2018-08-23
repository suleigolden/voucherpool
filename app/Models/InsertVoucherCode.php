<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InsertVoucherCode extends Model
{
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'voucher_code';

    protected $fillable = [
        'recipientID', 'recipientType','code','expiration','date_of_usage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
