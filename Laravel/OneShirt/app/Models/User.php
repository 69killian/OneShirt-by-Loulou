<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password_hash', 
        'phone_number', 'date_of_birth', 'address', 'postal_address', 
        'profile_picture', 'role'
    ];

    public function blogArticles()
    {
        return $this->hasMany(BlogArticle::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->password_hash = bcrypt($user->password_hash); // Utilisez `password_hash`
        });
    }
}
