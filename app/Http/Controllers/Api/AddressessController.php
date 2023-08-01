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

    public function add_address(AddAddressRequest $request){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
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
        $address->delete();
        return (new API)
            ->isOk(__('Data Deleted Successfully'))
            ->setData(AddressResources::collection($user->addressess))
            ->build();
    }
}
