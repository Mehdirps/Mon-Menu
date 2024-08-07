<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;


    protected $fillable = [
        'restaurant_id',
        'theme',
        'baseColor',
        'baseFamily',
        'titleColor',
        'titleFamily',
    ];

    // Relation vers le restaurant associé au design
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
