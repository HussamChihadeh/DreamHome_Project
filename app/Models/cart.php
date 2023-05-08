<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the property for which the tour was requested.
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
