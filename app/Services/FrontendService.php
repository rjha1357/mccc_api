<?php

namespace App\Services;

use DB;
use Hash;
use App\User;
use App\Models\User\RegisterUser;
use Illuminate\support\Facades\Cache;
use App\Models\States;
use App\Models\Cities;
use Auth;

class FrontendService

{   
    public function getRegisteredData($id)
    {
        return $id?RegisterUser::findOrFail($id): RegisterUser::all();
    }

    public function getallStates()
    {   
        // echo Cache::set("item", "Hello Cache");
        return $state = Cache::rememberForever('states', function(){
            return States::where('status','1')->get();
        });
        
    }

    public function getallCities($state_id)
    {
        return Cities::where('status','1')->where('state_id',$state_id)->get();
    }

    public function newUserRegistration($data){
        try{
            
            $registerUser = RegisterUser::create([
                'name'              =>$data['Name'],
                'email'             =>$data['Email'],
                'phone'             =>$data['Phone'],
                'password'          => Hash::make($data['Password']),
                'dob'               =>$data['Dob'],
                'gender'            =>$data['gender'],
                'state_id'          =>$data['slecState'],
                'city_id'           =>$data['slecCity'],
                'google_login_id'   =>$data['googleId'],
                'facebook_login_id' =>$data['facebookId']

            ]);
            return $registerUser;
        }catch(Exception $exception){
            throw $exception;
        }
    }

    public function newOTPInsert($data){
        try{
            $otp = mt_rand(1000,9999);
            $user =  RegisterUser::where('phone', $data['phone'])
                                ->update(['otp' => $otp]);
            if($user){
                return $otp;
            }
            
            // $user =  RegisterUser::where('phone', $data['phone'])->first();
            // $user->update([
            //     'otp' =>$otp,
            // ]);
            
        }catch (Exception $exception){
            throw $exception;
        }
    }

    public function googleLoginCheck($req)
    {
        $user = RegisterUser::where('google_login_id', $req['googleId'])->first();
        if(!$user){
            $user = RegisterUser::create([ 
                'name'              =>$req['Name'],
                'email'             =>$req['Email'],
                'google_login_id'   =>$req['googleId'],
            ]);
        }
            Auth::login($user);
            $data["status"] = 'true';
            $data["user"] = $user;
            $data["token"] = $user->createToken('TutsForWeb')->accessToken;
            return $data;
    }

    public function facebookLoginCheck($req)
    {
        $user = RegisterUser::where('facebook_login_id', $req['facebookId'])->first();
        if(!$user){
            $user = RegisterUser::create([ 
                'name'              =>$req['Name'],
                'email'             =>$req['Email'],
                'facebook_login_id'   =>$req['facebookId'],
            ]);
        }
            Auth::login($user);
            $data["status"] = 'success';
            $data["user"] = $user;
            $data["token"] = $user->createToken('TutsForWeb')->accessToken;
            return $data;
    }
}