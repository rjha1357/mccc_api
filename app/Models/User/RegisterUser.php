<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class RegisterUser extends Authenticatable
{   
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'dob', 'gender', 'facebook_login_id' , 'google_login_id' ,'state_id','city_id','is_active','is_delete',
    ];
    public $timestamps = true;
    protected $table = 'registeredusers';
    // use HasFactory;

    public function AauthAcessToken(){
        return $this->hasMany('\App\OauthAccessToken');
    }
}

