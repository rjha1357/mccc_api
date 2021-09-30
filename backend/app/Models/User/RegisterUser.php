<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

class RegisterUser extends Authenticatable
{   
    use HasApiTokens, Notifiable;
    
    // $user = Auth::user()->token();
    // $user->revoke();
    // return 'logged out'; // modify as per your need

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'dob', 'gender','state_id','city_id','is_active','is_delete',
    ];
    public $timestamps = true;
    protected $table = 'registeredusers';
    // use HasFactory;
    
    protected $hidden = [
        'password',
    ];

    public function AauthAcessToken(){
        return $this->hasMany('\App\OauthAccessToken');
    }
}

