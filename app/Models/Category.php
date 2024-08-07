<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Category extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'image',
        'slug',
        'childs'
    ];

    protected $casts = [
        'childs' => 'array'
    ];

    /**
     * Get user record associated with the subscription.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->using('App\Models\CategoryProduct');
    }


}
