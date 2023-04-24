<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'price',
        'description',
        'province',
        'city',
        'street',
        'latitude',
        'longitude',
        'type',
        'parking',
        'bedrooms',
        'bathrooms',
        'area',
        'built_in',
        'buy_or_rent',
    ];
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
