<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AdminAuthService;
use App\Models\User\RegisterUser;
use Auth;
use Validator;

class AdminAuthController extends Controller
{
    protected $adminAuthService;

    public function __construct(AdminAuthService $adminAuthService) {
        $this->adminAuthService = $adminAuthService;
    }


    public function Userlogin(Request $request) {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $userDetails = Auth::user();
                $token = $userDetails->createToken('TutsForWeb')->accessToken;
                return response()->json(['status'=> 'success', 'user' => $userDetails,'access_token' => $token], 200);
                // return response()->json($token, 200);
            } else {
                return response()->json(['message' => 'Please Enter Valid Username and Password'], 400);
            }
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function checkAdminEmail(Request $request) {

        return $this->adminAuthService->checkAdminEmail($request);
    }

    public function logout(){
        // $accessToken = auth()->user()->token();
        // $token= $request->user()->tokens->find($accessToken);
        // $token->revoke();
        // $response = ['message' => 'You have logout successfully'];
        // return response($response, 200);

        if (Auth::check()) {
            // print_r('checked');exit;
            Auth::user()->AauthAcessToken()->delete();
         }

       
    }
}
