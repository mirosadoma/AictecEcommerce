<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Resources
use App\Http\Resources\Api\ProductsResources;
// Models
use App\Models\Categories\Category;
use App\Models\OfferPrices\OfferPrice;
use App\Models\OfferPrices\OfferPricesData;
use App\Support\API;

class OfferPricesController extends Controller {

    public function send_offer_prices(Request $request){
        if ($request->type == "data") {
            $all_data = $request->all();
            $all_data['number'] = time();
            if (request()->has('commercial_registry_file') && $request->commercial_registry_file != NULL) {
                $all_data['commercial_registry_file']  = fileUpload($request->commercial_registry_file, 'offer_prices');
            }
            $offer_price = OfferPrice::create($all_data);
            $data = $all_data['data'];
            foreach ($data as $value) {
                $value['offer_price_id'] = $offer_price->id;
                OfferPricesData::create($value);
            }
        } else {
            $all_data = $request->all();
            $all_data['number'] = time();
            if (request()->has('file') && $request->file != NULL) {
                $all_data['file']  = fileUpload($request->file, 'offer_prices');
            }
            if (request()->has('commercial_registry_file') && $request->commercial_registry_file != NULL) {
                $all_data['commercial_registry_file']  = fileUpload($request->commercial_registry_file, 'offer_prices');
            }
            OfferPrice::create($all_data);
        }
        return (new API)
            ->isOk(__('Message Send Successfully'))
            ->build();
    }

    public function get_products(){
        $category = Category::find(request('category_id'));
        if (!$category) {
            return (new API)
                ->isError(__('Category Not Found'))
                ->build();
        }
        return (new API)
            ->isOk(__('Products From Category'))
            ->setData(ProductsResources::collection($category->products))
            ->build();
    }

}
