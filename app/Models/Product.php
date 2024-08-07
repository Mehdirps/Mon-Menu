<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product   extends Model
{
    use HasFactory;


    protected $fillable = [
        "name",
        "content",
        "price",
        "active",
        "image",
        "order",
    ];


    /**
     * Get user record associated with the subscription.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->using('App\Models\CategoryProduct');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
