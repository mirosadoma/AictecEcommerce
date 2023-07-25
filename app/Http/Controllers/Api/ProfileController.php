<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Requests
use App\Http\Requests\Api\Profile\ProfileRequest;
use App\Http\Requests\Api\Profile\NewPasswordRequest;
// Resources
use App\Http\Resources\Api\ClientResources;
// Models
use App\Models\SendSms;
use App\Support\API;
use Hash;

class ProfileController extends Controller {

    public function view_profile(){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        return (new API)
            ->isOk(__('Your Profile Data'))
            ->setData(new ClientResources($user))
            ->build();
    }

    public function save_profile(ProfileRequest $request){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        $user->update([
            'name'              =>  $request->name,
            'email'             =>  $request->email,
            'phone'             =>  $request->phone,
        ]);
        return (new API)
            ->isOk(__('Data Updated Successfuly'))
            ->setData(new ClientResources($user))
            ->build();
    }

    public function new_password(NewPasswordRequest $request){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        if (!Hash::check($request->old_password ,$user->password)) {
            return (new API)
                ->isError(__('Old password does not match'))
                ->build();
        }
        if ($request->password == $request->old_password) {
            return (new API)
                ->isError(__('Old and new password must not be the same'))
                ->build();
        }
        $user->update(['password' => Hash::make($request->password)]);
        return (new API)
            ->isOk(__('Password Reset successfully'))
            ->setData(new ClientResources($user))
            ->build();
    }
}
