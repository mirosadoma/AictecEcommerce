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
use App\Http\Resources\Api\OrdersResources;
use App\Models\Orders\Order;
// Models
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

    public function my_orders(){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        $orders = [];
        if (request('status') == 'in_process') {
            $orders = $user->orders()->whereIn('status', [Order::STATUS_PAID,Order::STATUS_IN_PROCESS,Order::STATUS_ASSIGNED])->paginate();
        }else{
            $orders = $user->orders()->where('status', request('status'))->paginate();
        }
        return (new API)
            ->isOk(__('My Orders'))
            ->setData(OrdersResources::collection($orders))
            ->addAttribute("paginate",api_model_set_paginate($orders))
            ->build();
    }

    public function get_wallet(){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
            ->isError(__('Please Login First'))
            ->build();
        }
        return (new API)
            ->isOk(__('My Wallet'))
            ->setData([
                'wallet' => floatval($user->wallet),
            ])
            ->build();
    }
}
