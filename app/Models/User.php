<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Restaurant;
use App\Models\Suggestion;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'restaurant_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the restaurant that owns the user.
     */
    public function restaurant()
    {
        //  return $this->belongsTo(Restaurant::class);
        return $this->hasOne(Restaurant::class, 'admin_id');
    }

    /**
     * Get the Restaurant for the admin user.
     */
    public function adminOf()
    {
        return $this->hasOne(Restaurant::class, 'admin_id', 'id');
    }

    /**
     * Check if user is admin
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role == 0;
    }

    /**
     * Check if user is admin
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->email == 'cliondor@gmail.com';
    }

    /**
     * Get the user that owns the restaurant.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }
}
