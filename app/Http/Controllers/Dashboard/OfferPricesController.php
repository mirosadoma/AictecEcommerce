<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\OfferPricesExport;
use Maatwebsite\Excel\Facades\Excel;
// Models
use App\Models\OfferPrices\OfferPrice;

class OfferPricesController extends Controller {

    public function index() {
        if (!permissionCheck('offer_prices.view')) {
            return abort(403);
        }
        $lists = OfferPrice::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('help_center') && !empty(request('help_center'))) {
                $lists->whereTranslationLike("help_center","%".request('help_center')."%");
            }
            if (request()->has('number') && !is_null(request('number'))) {
                $lists->where('number', request('number'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.offer_prices.index',get_defined_vars());
    }

    public function show($offer_price)
    {
        $offer_price = OfferPrice::where('id', $offer_price)->first();
        if (!$offer_price) {
            abort(404);
        }
        return view('admin.offer_prices.show', get_defined_vars());
    }

    public function export($offer_price)
    {
        return \Excel::download(new OfferPricesExport($offer_price), 'offer_prices.xlsx');
    }
}
