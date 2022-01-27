<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            if($token = Auth::guard('admin')->attempt(['email' => $request->email , 'password' => $request->password])){
                return $this->respondWithSuccess(['token' => $token]);
            }
            return $this->respondError("Wrong Email or Password");
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            Auth::guard('admin')->logout();
            return $this->respondWithSuccess(['message' => 'Successfully logged out']);
        } catch (\Throwable $th) {
            $this->respondError($th->getMessage());
        }
    }
}
