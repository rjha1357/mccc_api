<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AdminAuthService;
use App\Models\User\RegisterUser;
use App\Http\Requests\LoginValidate;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserDetailResource;
// use Auth;
use Validator;

class AdminAuthController extends Controller
{
    protected $adminAuthService;

    public function __construct(AdminAuthService $adminAuthService) {
        $this->adminAuthService = $adminAuthService;
    }


    public function Userlogin(LoginValidate $request) {
        try {
            
            if(is_numeric($request->get('email_or_mobile'))){
                if (Auth::attempt(['phone' => $request->email_or_mobile, 'password' => $request->password])) {
                    $userDetails = [ 'id'        => Auth::user()->id,
                                     'name'      => Auth::user()->name,
                                     'email'     => Auth::user()->email,
                                     'phone'     => Auth::user()->phone,
                                     'gender'    => Auth::user()->gender,
                                     'dob'       => Auth::user()->dob,
                                     'state_id'  => Auth::user()->state_id,
                                     'city_id'   => Auth::user()->city_id,
                                     'is_active' => Auth::user()->is_active,
                                     'created_at'=> date('d-m-Y', strtotime(Auth::user()->created_at)),
                                ];
                    $user =  Auth::user();
                    
                }else {
                    return response()->json(['status' => 'false','code' => '400', 'message' => 'Please Enter Valid Username and Password']);
                }
                
            }elseif(filter_var($request->get('email_or_mobile'), FILTER_VALIDATE_EMAIL)){
                if (Auth::attempt(['email' => $request->email_or_mobile, 'password' => $request->password])) {
                   $userDetails = [ 'id'        => Auth::user()->id,
                                    'name'      => Auth::user()->name,
                                    'email'     => Auth::user()->email,
                                    'phone'     => Auth::user()->phone,
                                    'gender'    => Auth::user()->gender,
                                    'dob'       => Auth::user()->dob,
                                    'state_id'  => Auth::user()->state_id,
                                    'city_id'   => Auth::user()->city_id,
                                    'is_active' => Auth::user()->is_active,
                                    'created_at'=> date('d-m-Y', strtotime(Auth::user()->created_at)),
                                ];
                    $user =  Auth::user();          
                }else {
                    return response()->json(['status' => 'false','code' => '400', 'message' => 'Please Enter Valid Username and Password']);
                }
            }
            
            if($userDetails){
            $token = $user->createToken('TutsForWeb')->accessToken;
            return response()->json(['status'=> 'true','code' => '200', 'userDetails' => $userDetails,'token' => $token]);
            // return response()->json($token, 200);
             } else {
            return response()->json(['status' => 'false','message' => 'Something went wrong while login! Please Try again','code' => '500']);
            }
        } catch (\Exception $ex) {
            return response()->json(['status' => 'false','code' => '500','message' => $ex->getMessage()]);
        }
    }

    public function checkAdminEmail(Request $request) {
         $validatedData = $request->validate([
               'email' => 'required|email|max:28',
           ],
            [
                'email.required'=> 'Email is Required', // custom message
                'email.email'=> 'Please enter valid email address', // custom message
            ]);
        try{
            return $this->adminAuthService->checkAdminEmail($request);
            
        }catch(\Exception $ex){
            return response()->json(['status' => 'false','code' => '500','message' => $ex->getMessage()]);
        }
        
       
    }

    public function logout(Request $request){
        try{
           if (Auth::check()) {
            $user = Auth::user()->AauthAcessToken();
            return $user;
            // print_r($user);exit;
        }else{
           return 'error' ;
        }
        }catch(\Exception $ex){
            return response()->json(['status' => 'false','code' => '500','message' => $ex->getMessage()]);
        }
        
            // $result = Auth::user()->token()->revoke();
            // print_r($result);exit;
            // if($result){
            //         $response = response()->json(['status'=> 'success', 'error'=>false,'message'=>'User logout successfully.','result'=>[]],200);
            //   }else{
            //         $response = response()->json(['status' => 'error','error'=>true,'message'=>'Something is wrong.','result'=>[]],400);            
            //   }   
            // return $response;
       
    }
    
    public function forgotPassword(){
        
    }
    
    public function resetPassword(){
        
    }
}
