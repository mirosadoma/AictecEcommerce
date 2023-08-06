<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                    => (int) $this->id,
            'number'                => (int) $this->number,
            'payment_method'        => (string) $this->payment_method,
            'products_count'        => $this->products ? $this->products->count() : 0,
            'first_product_image'   => (string) $this->products ? $this->products()->first()->main_image_path : "",
            'created_at'            => (string) $this->created_at ? $this->created_at->diffForHumans() : "",
            'products'              => (array) ($this->products->count()) ? ProductsResources::collection($this->products) : [],
            'coupon'                => $this->coupon ? new CouponResources($this->coupon) : [],
            'installation_service'  => (int) $this->installation_service,
            'grand_total'           => (float) $this->grand_total,
            'discount'              => (float) $this->discount,
            'delivery_charge'       => (float) $this->delivery_charge,
            'final_total'           => (float) $this->final_total,
            'address'               => $this->address ? new AddressResources($this->address) : [],
        ];
    }
}
