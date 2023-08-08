@extends('admin.layouts.master')
@section('head_title'){{__('Offer Prices')}}@endsection
@push('styles')
    <style>
        .changeStatus{
            color: #ffffff;
            background: #0aa038;
            display: block;
            margin: 0 10px;
            padding: 5px 15px;
            font-size: 15px;
        }
        .errorStatus{
            color: #ffffff;
            background: rgb(131, 12, 12);
            display: block;
            margin: 0 10px;
            padding: 5px 15px;
            font-size: 15px;
        }
    </style>
@endpush
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Offer Prices'),
        'route' =>  'offer_prices.index',
    ],
    [
        'name'  =>  __('Show'),
        'route' =>  'offer_prices.show',
    ],
],'button' => [
        'title' => __('Back To Offer Prices'),
        'route' =>  'offer_prices.index',
        'icon'  => 'arrow-left'
]])

<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> @lang("Offer Prices Data") </h5>
                        <div class="heading-elements" style="display: flex;">
                            <?php $link = route('app.order_print', $offer_price->id); ?>
                            <a class="btn btn-primary" onClick="MyWindow=window.open('{!! $link !!}','MyWindow','width=1000,height=500'); return false;" type="button" class="btn btn-dark legitRipple">
                               @lang('Print')
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <fieldset>
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("ID")</th>
                                        <td>{{$offer_price->id}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Full Name")</th>
                                        <td>{{$offer_price->full_name??"------"}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Number")</th>
                                        <td>{{$offer_price->number??"------"}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Phone")</th>
                                        <td>{{$offer_price->phone??"------"}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Email")</th>
                                        <td>{{$offer_price->email??"------"}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Company Url")</th>
                                        <td>{{$offer_price->company_url??"------"}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Commercial Registry File")</th>
                                        <td>{{ explode('/offer_prices/', $offer_price->commercial_registry_file_path)[1] ??"------"}}
                                            @if ($offer_price->commercial_registry_file)
                                                <embed
                                                    src="{{$offer_price->commercial_registry_file_path}}"
                                                    type="application/pdf"
                                                    frameBorder="0"
                                                    scrolling="auto"
                                                    height="800px"
                                                    width="100%"
                                                ></embed>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Type")</th>
                                        <td>{{__(\Str::ucfirst($offer_price->type))??"------"}}</td>
                                    </tr>
                                    @if ($offer_price->type == 'file')
                                        <tr>
                                            <th {!! \table_width_head(8) !!}>@lang("File")</th>
                                            <td>{{ explode('/offer_prices/', $offer_price->file_path)[1] ??"------"}}
                                                @if ($offer_price->file)
                                                    <embed
                                                        src="{{$offer_price->file_path}}"
                                                        type="application/pdf"
                                                        frameBorder="0"
                                                        scrolling="auto"
                                                        height="800px"
                                                        width="100%"
                                                    ></embed>
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th {!! \table_width_head(8) !!}>@lang("Data")</th>
                                            <td>
                                                <a href="{{route('app.offer_prices.export', $offer_price->id)}}" class="btn btn-instagram btn-round waves-effect waves-float waves-light">@lang("Export Exel File")</a>
                                                <br>
                                                <br>
                                                <table class="table table-bordered table-sm">
                                                    <tr>
                                                        <th colspan="4" class="text-center">@lang('Information')</th>
                                                    </tr>
                                                    <tr>
                                                        <th>@lang('Category')</th>
                                                        <th>@lang('Products')</th>
                                                        <th>@lang('Quantity')</th>
                                                    </tr>
                                                    @if($offer_price->offer_prices_data)
                                                        @foreach ($offer_price->offer_prices_data()->groupBy('category_id')->get() as $offer_prices_data)
                                                            <tr>
                                                                <td>
                                                                    {{ $offer_prices_data->category ? $offer_prices_data->category->name : __("Category Not Found")}}
                                                                </td>
                                                                @if($offer_prices_data->category->offer_prices_data)
                                                                    <td>
                                                                        <ul>
                                                                            @foreach ($offer_prices_data->category->offer_prices_data as $item)
                                                                                <li>{{$item->product->title??""}}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                @else
                                                                    <td colspan="3">@lang("No Products Found")</td>
                                                                @endif
                                                                <td>
                                                                    {{ $offer_prices_data->quantity??__("Not Found")}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="3">@lang("No Data Found")</td>
                                                        </tr>
                                                    @endif
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
