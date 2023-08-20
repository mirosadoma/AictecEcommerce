<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Models
use App\Models\Settings\SiteConfig;
use App\Models\Settings\SiteSocial;
use App\Models\Settings\SiteMaintenance;
use App\Models\Settings\TermsAndCondition;
use App\Models\Settings\DeliveryAdderss;
use App\Models\Cities\City;
use App\Support\Aymakan;

class SettingsController extends Controller {

    public function config() {
        if (!permissionCheck('settings.config')) {
            return abort(403);
        }
        $setting = SiteConfig::first();
        return view('admin.settings.config',get_defined_vars());
    }
    public function social() {
        if (!permissionCheck('settings.social')) {
            return abort(403);
        }
        $contacts = SiteSocial::all();
        return view('admin.settings.social',get_defined_vars());
    }
    public function maintenance() {
        if (!permissionCheck('settings.maintenance')) {
            return abort(403);
        }
        $setting = SiteMaintenance::first();
        return view('admin.settings.maintenance',get_defined_vars());
    }
    public function terms_and_conditions() {
        if (!permissionCheck('settings.terms_and_conditions')) {
            return abort(403);
        }
        $setting = SiteMaintenance::first();
        return view('admin.settings.terms_and_conditions',get_defined_vars());
    }

    public function delivery_adderss() {
        if (!permissionCheck('settings.terms_and_conditions')) {
            return abort(403);
        }
        $setting = DeliveryAdderss::first();
        $cities = City::all();
        return view('admin.settings.delivery_adderss',get_defined_vars());
    }

    public function update(Request $request, $type) {
        if (!permissionCheck('settings.update')) {
            return abort(403);
        }
        $data = $request->all();
        if($type == 'config'){
            Validator::make($request->all(),[
                'ar.title'              => 'required|string|between:2,500',
                'en.title'              => 'required|string|between:2,500',
                'ar.address'            => 'required|string|between:2,1000',
                'en.address'            => 'required|string|between:2,1000',
                'email'                 => 'required|email:filter|between:2,200',
                'phone'                 => 'required',
                // 'phone'                 => 'required|digits:9|regex:/^(5)?([0-9]){2}([0-9]){6}$/',
                'tax'                   => 'required',
                'delivery_charge'       => 'required',
                // 'appstore'              => 'required|between:2,200',
                // 'googleplay'            => 'required|between:2,200',
                'logo'                  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'footer_logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'icon'                  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ],[],[
                'delivery_charge'       => __('Delivery Charge'),
                'tax'                   => __('Tax'),
            ])->validate();
            $setting = SiteConfig::first();
            if (request()->has('logo') && $request->logo != NULL) {
                $data['logo']      = imageUpload($request->logo, 'settings', [], false, true, $setting->logo);
            }else{
                unset($data['logo']);
            }
            if (request()->has('footer_logo') && $request->footer_logo != NULL) {
                $data['footer_logo']      = imageUpload($request->footer_logo, 'settings', [], false, true, $setting->footer_logo);
            }else{
                unset($data['footer_logo']);
            }
            if (request()->has('icon') && $request->icon != NULL) {
                $data['icon']      = imageUpload($request->icon, 'settings', [], false, true, $setting->icon);
            }else{
                unset($data['icon']);
            }
            $setting->update($data);
            return redirect()->back()->with('success', __('Data Updated Successfully'));
        }else if($type == 'social'){
            $social = SiteSocial::truncate();
            $i = 0;
            foreach ($data['type'] as $tp) {
                if ($data['value'][$i] && $data['value'][$i] != '' && $data['value'][$i] != ' ') {
                    $social->create([
                        'type' => $data['type'][$i],
                        'class' => $data['class'][$i],
                        'value' => $data['value'][$i]
                    ]);
                }
                $i++;
            }
            return redirect()->back()->with('success', __('Data Updated Successfully'));
        }else if($type == 'maintenance'){
            $setting = SiteMaintenance::first();
            $setting->update($data);
            return redirect()->back()->with('success', __('Data Updated Successfully'));
        }else if($type == 'terms_and_conditions'){
            $setting = TermsAndCondition::first();
            $setting->update($data);
            return redirect()->back()->with('success', __('Data Updated Successfully'));
        }else if($type == 'delivery_adderss'){
            Validator::make($request->all(),[
                'address_title'         => 'required',
                'address_name'          => 'required',
                'address_email'         => 'required',
                'address_address'       => 'required',
                'address_city'          => 'required|exists:cities,id',
                'address_neighbourhood' => 'required',
                'address_postcode'      => 'required',
                'address_phone'         => 'required',
                'address_description'   => 'required',
            ],[],[
                'address_title'         => __('Title'),
                'address_name'          => __('Name'),
                'address_email'         => __('Email'),
                'address_address'       => __('Address'),
                'address_city'          => __('City'),
                'address_neighbourhood' => __('Address Neighbourhood'),
                'address_postcode'      => __('Postal Code'),
                'address_phone'         => __('Phone'),
                'address_description'   => __('Description'),
            ])->validate();
            unset($data['_token']);

            $setting = DeliveryAdderss::first();
            $setting->update($data);

            (new Aymakan())->addAddress($data);

            return redirect()->back()->with('success', __('Data Updated Successfully'));
        }
    }

    public function remove_logo($setting) {
        $setting = SiteConfig::find($setting);
        DeleteFile($setting->logo);
        $setting->update([
            'logo' => null
        ]);
        return response()->json([
            'message' => __('Logo Deleted Successfully'),
        ]);
    }

    public function remove_footer_logo($setting) {
        $setting = SiteConfig::find($setting);
        DeleteFile($setting->footer_logo);
        $setting->update([
            'footer_logo' => null
        ]);
        return response()->json([
            'message' => __('Logo Deleted Successfully'),
        ]);
    }

    public function remove_icon($setting) {
        $setting = SiteConfig::find($setting);
        DeleteFile($setting->icon);
        $setting->update([
            'icon' => null
        ]);
        return response()->json([
            'message' => __('Logo Deleted Successfully'),
        ]);
    }
}
