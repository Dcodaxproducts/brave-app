<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Validator;
use Google\Client;
use Google\Service\Oauth2;
use App\Models\UserVerify;
use Hash;
use Illuminate\Support\Str;
use Mail; 

class UserController extends BaseController
{
    public function redirectToGoogle()
    {
        $client = new Client();
        $client->setClientId('301870924033-tpsmbk53vvbt0vkavp02see7un976otf.apps.googleusercontent.com');
        $client->setClientSecret('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');
        $client->setRedirectUri('https://brave.hostdonor.com/api/signin/google/callback');
        $client->addScope('email');
        $client->addScope('profile');

        return redirect($client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        // Check if the user already exists in your database
        $user = User::where('google_oauth_key', $google_id)->first();
        if ($user) {
            // User already exists, return a response with a message
            Auth::login($user);
            $success['email'] =  $user->email;
            $success['user'] =  $user;
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            $newUser = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'google_oauth_key'=> $request->google_id,
                'image'=> $request->image_url ?? NULL,
                'password' => encrypt('123456')
            ]);
  
            Auth::login($newUser);
  
            $success['token'] =  $newUser->createToken('MyApp')->accessToken;
            $success['user'] =  $newUser;
            return $this->sendResponse($success, 'User register successfully.');
        }
        
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            // 'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 400);        
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/images', $imageName);
            $input['image'] = $path;
        }

        $input = $request->all();
        // dd($input);
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        // $token = Str::random(64);
        // UserVerify::create([
        // 'user_id' => $user->id, 
        // 'token' => $token
        // ]);

        // Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($request){
        // $message->to($request->email);
        // $message->subject('Email Verification Mail');
        // });

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['user'] =  $user;
   
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['user'] =  $user;
            $success['email'] =  $user->email;
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->token()->revoke();
        return $this->sendResponse([], 'User logged out successfully.');
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
        if(!is_null($verifyUser) ){
        $user = $verifyUser->user;
        if(!$user->is_email_verified) {
        $verifyUser->user->is_email_verified = 1;
        $verifyUser->user->save();
            $message = "Your e-mail is verified. You can now login.";
        } else {
            $message = "Your e-mail is already verified. You can now login.";
        }
        }
    }
}
