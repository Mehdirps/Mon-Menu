<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewStatistic extends Model
{
    use HasFactory;

protected $fillable = [
        'restaurant_id', 'url', 'views', 'viewed_at',
    ];

     public $timestamps = false;

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

}
