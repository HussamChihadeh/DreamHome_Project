<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Designer;
// use App\Models\Designer;
class Furniture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'style',
        'description',
        'material',
        'place',
        'date',
        'price',
        'designer_id',
        'quantity',
    ];
    public function designers(){
        return $this->belongsTo(Designer::class, 'designer_id');
    }
}
