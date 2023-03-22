<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\UserVerify;
use Twilio\Rest\Client;
use Validator;

class VerificationController extends BaseController
{
    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phoneNumber' => 'required',
        ]);
   
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 400);      
        }

        
        $user = auth()->user()->id;
        if($user){
            $token = rand(100000, 999999);
            $message = "Here is your OTP $token" ;
    
            UserVerify::create([
                'user_id' => $user, 
                'token' => $token
            ]);
    
            $twilio = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
            $twilio->messages->create($request->phoneNumber,
                            array(
                                "messagingServiceSid" => env('TWILIO_SERVICE_ID'),
                                "body" => $message,
                            )
                        );

            return response()->json([
                'status' => 'success',
                'message' => 'Verification code sent to your phone.',
            ]);

        }else{

            return response()->json([
                'status' => 'error',
                'message' => 'You are not loggedin user',
            ]);

        }
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phoneNumber' => 'required',
            'otp' => 'required'
        ]);
    
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $user = auth()->user();
    
        if($user){
    
            $userVerify = UserVerify::where('user_id', $user->id)
                            ->where('token', $request->otp)
                            ->first();
    
            if($userVerify){
    
                $user->phoneNumber = $request->phoneNumber;
                $user->phone_verified = 1;
                $user->save();
                $userVerify->delete();
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Phone number verified successfully.',
                ]);
    
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid OTP.',
                ]);
            }
    
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'You are not loggedin user',
            ]);
        }
    }
}
