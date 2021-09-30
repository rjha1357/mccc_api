<?php
namespace App\Services;

use Exception;
use App\Models\User\RegisterUser;
use DB;

class AdminAuthService
{
    public function checkAdminEmail($data)
    {   
        // print_r($data['email']);exit;
    	$admin = RegisterUser::where('email', $data['email'])->count();
    	return ($admin > 0) ? 'true' : 'false';
    }
}