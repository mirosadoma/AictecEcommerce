<?php

namespace App\Exports;

use App\Models\Orders\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    public function view(): View
    {
        $orders = Order::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('user') && !empty(request('user'))) {
                $orders->whereHas('user', function ($q) {
                    return $q->where('name', 'LIKE', "%".request('user')."%");
                });
            }
            if (request()->has('status') && !is_null(request('status'))) {
                $orders->where('status', request('status'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $orders->whereDate('created_at', request('created_at'));
            }
            if (request()->has('city_id') && !empty(request('city_id'))) {
                $orders = $orders->whereHas('address', function($query) {
                    $query->whereHas('city', function($q) {
                        return $q->where('city_id', request('city_id'));
                    });
                });
            }
            if (request()->has('district_id') && !empty(request('district_id'))) {
                $orders = $orders->whereHas('address', function($query) {
                    return $query->where('district', 'LIKE', "%".request('district')."%");
                });
            }
        }
        $orders = $orders->orderBy('id', "DESC")->get();

        $all_data = [];
        foreach ($orders as $value) {
            $all_data[] = $this->one_object($value);
        }
        return view('exports.orders', [
            'all_data' => $all_data
        ]);
    }

    private function one_object($data){
        return [
            'id' => $data->id,
            'number' => $data->number,
            'user' => $data->user->name,
            'address' => [
                'full_name' => $data->address->full_name,
                'phone' => $data->address->phone,
                'street_address' => $data->address->street_address,
                'building_number' => $data->address->building_number,
                'floor_number' => $data->address->floor_number,
                'postal_code' => $data->address->postal_code,
                'lat' => $data->address->lat,
                'lng' => $data->address->lng,
                'google_address' => $data->address->google_address,
                'city' => $data->address->city->name,
                'district' => $data->address->district,
            ],
            'coupon' => [
                'start_date' => $data->coupon->start_date,
                'end_date' => $data->coupon->end_date,
                'code' => $data->coupon->code,
                'type' => $data->coupon->type,
                'value' => $data->coupon->value,
            ],
            'payment_method' => $data->payment_method,
            'status' => $data->status,
            'sub_total' => $data->sub_total,
            'tax' => $data->tax,
            'grand_total' => $data->grand_total,
            'discount' => $data->discount,
            'payment' => $data->payment,
            'wallet' => $data->wallet,
            'delivery_charge' => $data->delivery_charge,
            'final_total' => $data->final_total,
            'cancel_reson' => $data->cancel_reson,
            'installation_service' => $data->installation_service,
            'created_at' => $data->created_at,
        ];

    }
}
