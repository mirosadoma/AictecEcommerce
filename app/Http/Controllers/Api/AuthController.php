<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
// Requests
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\ForgetRequest;
use App\Http\Requests\Api\Auth\CheckCodeRequest;
use App\Http\Requests\Api\Auth\ResetRequest;
// Resources
use App\Http\Resources\Api\ClientResources;
// Models
use App\Support\SMS;
use App\Models\User;
use App\Support\API;
use Hash;

class AuthController extends Controller {

    public function login(LoginRequest $request){
        $user = User::whereEmail($request->email)->first();
        if(!$user) {
            return (new API)
                ->isError(__('This user not found'))
                ->build();
        }

        if($token=Auth::guard('api')->attempt(['email' => request('email'), 'password' => request('password')])){
            if($user->is_active == 0) {
                auth('api')->logout();
                return (new API)
                    ->isError(__('This user not active from adminstrator'))
                    ->build();
            }
            // if(is_null($user->phone_verified_at)) {
            //     auth('api')->logout();
            //     return (new API)
            //         ->isError(__('This user not active from adminstrator'))
            //         ->build();
            // }
            $auth_data = $this->CreateNewToken($token);
            $user = Auth::guard('api')->user();

            return (new API)
                ->isOk(__('You are logged in successfully'))
                ->setData(new ClientResources($user))
                ->addAttribute("auth_data", $auth_data)
                ->build();
        }else{
            return (new API)
                ->isError(__('The login information is incorrect'))
                ->build();
        }
    }

    // public function login(LoginRequest $request)
    // {
    //     $authOnce = \Auth::guard('api')->once([
    //         'email'    => $request->email,
    //         'password' => $request->password,
    //     ]);
    //     if(!$authOnce) {
    //         $msg = api_msg($request , 'بيانات الدخول غير صحيحة' ,'The login information is incorrect');
    //         return response()->json(api_response($msg), $this->ErrorStatus);
    //     }
    //     $user = User::find(\Auth::guard('api')->getUser()->id);
    //     if($user->is_active == 0) {
    //         $msg = api_msg($request , 'هذا المستخدم غير مفعل من قبل الإدارة' ,'This user not active from adminstrator');
    //         return response()->json(api_response($msg), $this->ErrorStatus);
    //     }
    //     if(is_null($user->phone_verified_at)) {
    //         $msg = api_msg($request , 'لم يتم تأكيد كود التفعيل' ,'Activation code not confirmed');
    //         return response()->json(api_response($msg), $this->ErrorStatus);
    //     }
    //     dd(\Auth::guard('api')->getToken());
    //     $auth_data = $this->CreateNewToken(auth('api')->token());
    //     $msg = api_msg($request , 'تم تسجيل الدخول بنجاح' ,'You are logged in successfully');
    //     return response()->json(api_response($msg , ['auth_data'=>$auth_data,'user'=>new ClientResources($user)]), $this->successStatus);
    // }

    public function register(RegisterRequest $request){
        $info = [
            'name'              =>  $request->name,
            'email'             =>  $request->email,
            'phone'             =>  $request->phone,
            'is_active'         =>  1,
            'password'          =>  Hash::make($request->password),
        ];
        $info['type'] = 'client';
        $user = User::create($info);
        return (new API)
            ->isOk(__('Your data has been received'))
            ->setData(new ClientResources($user))
            ->build();
    }

    public function resend_code(Request $request){
        $user = User::where('phone', $request->phone)->first();
        if(!$user) {
            return (new API)
                ->isError(__('This user not found'))
                ->build();
        }
        $verification_code = generate_code();
        $user->update(['verification_code' => $verification_code]);
        $msg_send = api_msg($request , 'رقم التأكيد هو  ' ,'Verfication Code Is  ');
        try {
            (new SMS)->setPhone($user->phone)->SetMessage($msg_send. $user->verification_code)->build();
        } catch (\Throwable $th) {
            // return $th;
        }
        return (new API)
            ->isOk(__('The activation code has been successfully sent'))
            ->setData(['phone'=>$user->phone, 'verification_code'=>$user->verification_code])
            ->build();
    }

    public function check_code(CheckCodeRequest $request){
        $user = User::wherePhone($request->phone)->first();
        if(!$user) {
            return (new API)
                ->isError(__('This user not found'))
                ->build();
        }
        if($user->verification_code == $request->verification_code){
            $user->update([
                'phone_verified_at' => Carbon::now(),
                'verification_code' => $request->verification_code,
                ]);
            return (new API)
                ->isOk(__('The activation code has been confirmed successfully'))
                ->setData(new ClientResources($user))
                ->build();
        }
        else{
            return (new API)
                ->isError(__('Invalid verification code'))
                ->build();
        }
    }

    public function forget(ForgetRequest $request){
        $user = User::wherePhone($request->phone)->first();
        if(!$user) {
            return (new API)
                ->isError(__('This user not found'))
                ->build();
        }
        $verification_code = generate_code();
        $user->update(['verification_code' => $verification_code]);
        $msg_send = api_msg($request , 'رقم التأكيد هو  ' ,'Verfication Code Is  ');
        try {
            (new SMS)->setPhone($user->phone)->SetMessage($msg_send. $user->verification_code)->build();
        } catch (\Throwable $th) {
            // return $th;
        }
        return (new API)
            ->isOk(__('Activation code has been sent successfully'))
            ->setData(['phone'=>$user->phone, 'verification_code'=>$user->verification_code])
            ->build();
    }

    public function reset_password(ResetRequest $request){
        $user = User::wherePhone($request->phone)->first();
        if(!$user) {
            return (new API)
                ->isError(__('This user not found'))
                ->build();
        }
        $user->update([
            'password'      => Hash::make($request->password),
        ]);
        return (new API)
            ->isError(__('Successfully Reset Password, Go To Login Now'))
            ->build();
    }

    public function logout(){
        auth('api')->logout();
        return (new API)
            ->isOk(__('LogOut has been successfully'))
            ->build();
    }

    public function refresh(){
        $auth_data = $this->CreateNewToken(auth('api')->refresh());
        return (new API)
            ->isOk(__('Successfull'))
            ->addAttribute('auth_date', $auth_data)
            ->build();
    }

    public function CreateNewToken($token) {
        return [
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth('api')->factory()->getTTL()*200,
        ];
    }

    // ---------------------- Socials ----------------------

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('social_type', 'google')->where('social_id', $user->id)->orWhere('email', $user->email)->first();

            if($finduser){
                if($token=Auth::guard('api')->login($finduser)){
                    $auth_data = $this->CreateNewToken($token);
                    $user = Auth::guard('api')->user();

                    return (new API)
                        ->isOk(__('You are logged in successfully'))
                        ->setData(new ClientResources($user))
                        ->addAttribute("auth_data", $auth_data)
                        ->build();
                }else{
                    return (new API)
                        ->isError(__('The login information is incorrect'))
                        ->build();
                }
            }else{
                $newUser = User::create([
                    'name'          => $user->name,
                    'email'         => $user->email,
                    'social_id'     => $user->id,
                    'social_type'   => 'google',
                    'password'      => encrypt('gmail_123456')
                ]);

                if($token=Auth::guard('api')->attempt(['email' => $newUser->email, 'password' => 'gmail_123456'])){
                    $auth_data = $this->CreateNewToken($token);
                    $user = Auth::guard('api')->user();

                    return (new API)
                        ->isOk(__('You are logged in successfully'))
                        ->setData(new ClientResources($user))
                        ->addAttribute("auth_data", $auth_data)
                        ->build();
                }else{
                    return (new API)
                        ->isError(__('The login information is incorrect'))
                        ->build();
                }
            }

        } catch (\Exception $e) {
            return (new API)
                ->isError($e->getMessage())
                ->build();
        }
    }

    public function redirectToTwitter(){
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback(){
        try {

            $user = Socialite::driver('twitter')->user();
            $finduser = User::where('social_type', 'twitter')->where('social_id', $user->id)->orWhere('email', $user->email)->first();

            if($finduser){
                if($token=Auth::guard('api')->login($finduser)){
                    $auth_data = $this->CreateNewToken($token);
                    $user = Auth::guard('api')->user();

                    return (new API)
                        ->isOk(__('You are logged in successfully'))
                        ->setData(new ClientResources($user))
                        ->addAttribute("auth_data", $auth_data)
                        ->build();
                }else{
                    return (new API)
                        ->isError(__('The login information is incorrect'))
                        ->build();
                }
            }else{
                $newUser = User::create([
                    'name'          => $user->name,
                    'email'         => $user->email,
                    'social_id'     => $user->id,
                    'social_type'   => 'twitter',
                    'password'      => encrypt('twitter_123456')
                ]);

                if($token=Auth::guard('api')->attempt(['email' => $newUser->email, 'password' => 'twitter_123456'])){
                    $auth_data = $this->CreateNewToken($token);
                    $user = Auth::guard('api')->user();

                    return (new API)
                        ->isOk(__('You are logged in successfully'))
                        ->setData(new ClientResources($user))
                        ->addAttribute("auth_data", $auth_data)
                        ->build();
                }else{
                    return (new API)
                        ->isError(__('The login information is incorrect'))
                        ->build();
                }
            }

        } catch (\Exception $e) {
            return (new API)
                ->isError($e->getMessage())
                ->build();
        }
    }
}
