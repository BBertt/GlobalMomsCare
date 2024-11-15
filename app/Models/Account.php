<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory, Notifiable;

    protected $table = 'accounts';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function forums()
    {
        return $this->hasMany(Forum::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    public function orderDetails()
    {
        return $this->belongsToMany(OrderDetail::class, 'account_order_details');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
