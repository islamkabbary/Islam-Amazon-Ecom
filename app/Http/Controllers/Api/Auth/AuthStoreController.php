<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class AuthStoreController extends Controller
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
            if($token = Auth::guard('store')->attempt(['email' => $request->email , 'password' => $request->password])){
                // return $this->respondOk('login sucss');
                return redirect()->to('/n');
            }
            return $this->respondError("Wrong Email or Password");
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);
    //     $credentials = $request->except(['_token', 'remember']);
    //     $supplier = Store::where(['email'=> $request->email]);
    //     return redirect()->to('/n');
    // }


    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            Auth::guard('store')->logout();
            return $this->respondWithSuccess(['message' => 'Successfully logged out']);
        } catch (\Throwable $th) {
            $this->respondError($th->getMessage());
        }
    }
}
