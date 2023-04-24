<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'property_id', 'tour_date', 'tour_time'];

    /**
     * Get the user that requested the tour.
     */
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
