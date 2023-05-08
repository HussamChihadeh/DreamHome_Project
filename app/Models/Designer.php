<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'address',
        'phone_number',
        'age',
        'experience',
        'bio',
        'linkedin'
    ];

    public function furniture(){
        return $this->hasMany(Furniture::class);
    }
}
