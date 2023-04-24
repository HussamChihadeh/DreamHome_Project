<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Designer;
// use App\Models\Designer;
class Furniture extends Model
{
    use HasFactory;

    protected $fillable = ['designer_id', 'name'];
    public function designers(){
        return $this->belongsTo(Designer::class, 'designer_id');
    }
}
