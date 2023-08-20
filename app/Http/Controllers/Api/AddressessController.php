<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Requests
use App\Http\Requests\Api\Profile\AddAddressRequest;
// Resources
use App\Http\Resources\Api\AddressResources;
// Models
use App\Models\Addressess\Address;
use App\Support\API;

class AddressessController extends Controller {

    public function view_address(){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        return (new API)
            ->isOk(__('Your Address Data'))
            ->setData(AddressResources::collection($user->addressess))
            ->build();
    }

    public function show_address(Address $address){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        return (new API)
            ->isOk(__('Your Address Data'))
            ->setData(new AddressResources($address))
            ->build();
    }

    public function add_address(AddAddressRequest $request){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        if ($request->is_default == 1) {
            $user->addressess()->where('is_default', 1)->update(['is_default'=>0]);
        }
        $address = $user->addressess()->create($request->all());
        return (new API)
            ->isOk(__('Data Saved Successfully'))
            ->setData(new AddressResources($address))
            ->build();
    }

    public function update_address(AddAddressRequest $request, Address $address){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        if ($request->is_default == 1) {
            $user->addressess()->where('is_default', 1)->update(['is_default'=>0]);
        }
        $address->update($request->all());
        return (new API)
            ->isOk(__('Data Updated Successfully'))
            ->setData(new AddressResources($address))
            ->build();
    }

    public function delete_address(Request $request, Address $address){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        if($address->orders->count()){
            return (new API)
                ->isOk(__("You cannot delete this address now, as it is associated with an order"))
                ->build();
        }else{
            $address->delete();
            return (new API)
                ->isOk(__('Data Deleted Successfully'))
                ->setData(AddressResources::collection($user->addressess))
                ->build();
        }
    }
}
