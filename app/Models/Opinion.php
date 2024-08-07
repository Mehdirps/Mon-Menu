<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'restaurant_id',
        'note',
        'rgpd',
        'active',
       
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
