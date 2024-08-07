<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Opinion;


class Restaurant extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        'line',
        'address',
        'cp',
        'city',
        'content',
        'logo',
        'admin_id',
        'banner'
    ];


    /**
    * Get the users for the Restaurant.
    */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }

    /**
    * Get the admin user for the Restaurant.
    */
    public function admin()
    {
        return $this->hasOne(User::class,'id','admin_id');
    }



}
