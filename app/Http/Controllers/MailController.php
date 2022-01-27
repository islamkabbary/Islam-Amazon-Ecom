<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;


class MailController extends Controller
{
    public function forgetPassword(Request $request)
    {
        $user = User::where('email',$request->email);
        $code = $user->forget_code = Str::random(10);
        $user->code_expire = Carbon::now()->hour();
        $user->save();

        $data = [
            'template' => "forgetpassword",
            'recive_email' => $user->email,
            'data' => [
                'code' => $code,
                'link' => env('FRONT_URL'),   
            ]
        ];
        SendMail::dispatch($data);
    }
}