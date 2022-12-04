<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'discount_id',
        'date',
        'price',

    ];
    public function discount(){
        return $this->belongsTo(Discount::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
