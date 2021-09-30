<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Services\FrontendService;
use App\Http\Requests\RegisteredUsers;
use App\Http\Requests\GetCityValidation;
use Validator;
use Auth;
use File;

class FrontendController extends Controller
{   
    protected $frontendServices;

    public function __construct(FrontendService $frontendServices) {
        $this->frontendServices = $frontendServices;
    }
    //

    public function getRegisteredUsers($id = null)
    {
        try {
            $data = $this->frontendServices->getRegisteredData($id);
            return response()->json(['status' => 'true', 'code' => '200', 'data' => $data]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'false','message' => $ex->getMessage()], 500);
        }
    }
    
    
    public function test(){
        return view('about');
    }

    public function UserRegisteration(RegisteredUsers $request){
        // print_r($request);exit;
        try{
            $data = $this->frontendServices->newUserRegistration($request);
            
            return response()->json(['status' => 'true', 'code' => '201', 'data' => $data]);
        }catch(\Exception $ex){
            return response()->json(['status' => 'false','message' => $ex->getMessage()], 500);
        }
    }

    

    public function CheckGoogleId(Request $request){
        try {
            $data = $this->frontendServices->googleLoginCheck($request);
            
            return response()->json(['status' => 'true', 'code' => '201', 'data' => $data]);
            
        } catch (Exception $ex) {
            return response()->json(['status' => 'false','message' => $ex->getMessage()], 500);
        }
    }

    public function CheckFacebookId(Request $request){
        try {
            $data = $this->frontendServices->facebookLoginCheck($request);
            
            return response()->json(['status' => 'true','code' => '201', 'data' => $data]);
            
        } catch (Exception $ex) {
            return response()->json(['status' => 'false','message' => $ex->getMessage()], 500);
        }
    }


    public function  getStates(){
        try{
            // echo Cache::set("item", "Hello Cache");
            // echo Cache::get('item');
            $data = $this->frontendServices->getallStates();
            
            return response()->json(['status' => 'true','code' => '200', 'data' => $data]);
        }catch(Exception $ex){
            return response()->json(['status' => 'false','message' => $ex->getMessage()], 500);
        }
    }

    // public function  getCities($state_id){
    //     try{
    //         $data = $this->frontendServices->getallCities($state_id);
    //         return response()->json(['status' => 'success', 'code' => '200', 'data' => $data]);
    //     }catch(Exception $ex){
    //         return response()->json(['status' => 'error','message' => $ex->getMessage()], 500);
    //     }
    // }
    
    public function  getCities(GetCityValidation $request){
        try{
            $data = $this->frontendServices->getallCities($request);
            
            if(!$data->isEmpty()){
            return response()->json(['status' => 'true', 'code' => '200', 'data' => $data]);
            }else{
                 return response()->json(['status' => 'true', 'code' => '200', 'data' => 'no cities found']);
            }
        }catch(Exception $ex){
            return response()->json(['status' => 'false','message' => $ex->getMessage()], 500);
        }
    }
    
    public function termsConditions(){
         try{
            $data = $this->frontendServices->getTermsConditions();
            
            return response()->json(['status' => 'true','code' => '200', 'data' => $data]);
        }catch(Exception $ex){
            return response()->json(['status' => 'false','message' => $ex->getMessage()], 500);
        }
    }


    public function generateOTP(Request $request){ 
        try{
            $otp = mt_rand(1000,9999);
            return response()->json(['status' => 'true', 'code' => '200', 'otp' => $otp]);

        }catch(Exception $ex){
            return response()->json(['status' => 'false','message' => $ex->getMessage()], 500);
        }   
        // $data = $this->frontendServices->newOTPInsert($request);
        
    }

    public function displayImage($filename)
        {
            $path = storage_path('app/public/img/' . $filename);
            // $path = Storage::path('public/img/' . $filename);
            // print_r($path);exit;

            if (!File::exists($path)) {
                // print_r('hello');exit;
                abort(404);
            }

            $file = File::get($path);

            $type = File::mimeType($path);
            // print_r($file);exit;
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;

        }

}
