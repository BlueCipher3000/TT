<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['username', 'name', 'gender', 'password', 'img', 'privilege', 'status'];

    protected $hidden = ['password'];

    public $incrementing = true;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if ($user->privilege == 0) {
                throw new \Exception("Ban khong the tao user voi privilege 0.");
            }
        });

        static::updating(function ($user) {
            if ($user->privilege == 0) {
                throw new \Exception("Chi co the cap nhat user voi privilege 0 la user root.");
            }
        });
    }
}
