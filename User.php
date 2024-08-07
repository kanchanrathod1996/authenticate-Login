<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'middle_name',
        'last_name',
        'email',
        'gender',
       
        'language',
        'state',
        'city',
        'pincode',
        'contact',
        'image',
        'password',
 'is_email_verified',
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    // 

// first_name 	
// middle_name	
// last_name	
// email	
// id	

// gender	
// city	
// state	
// pincode	
// contact	
// address	
// image	
// password
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
  
}
