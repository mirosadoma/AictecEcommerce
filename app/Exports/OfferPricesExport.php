<?php

namespace App\Exports;

use App\Models\OfferPrices\OfferPrice;
use App\Models\OfferPrices\OfferPricesData;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OfferPricesExport implements FromView
{
    protected $offer_price_id;
    public function __construct($offer_price_id = null) {
        $this->offer_price_id = $offer_price_id;
    }

    public function view(): View
    {
        $offer_price = OfferPrice::find($this->offer_price_id);
        $all_data = [];
        foreach ($offer_price->offer_prices_data as $value) {
            $all_data[] = $this->one_object($value);
        }
        return view('exports.offer_prices', [
            'all_data' => $all_data
        ]);
    }

    private function one_object($data){
        $all = [
            'category'  => $data->category->name,
            'product'   => $data->product->title,
            'quantity'  => $data->quantity,
        ];
        return $all;

    }
}
