<?php
use App\Models\Orders\Order;
$order_statuses = [
    Order::STATUS_PAYMENTPENDDING,
    Order::STATUS_PLACED,
    Order::STATUS_IN_PROCESS,
    Order::STATUS_FIFNISHED,
    Order::STATUS_CANCELED,
];
?>
@extends('admin.layouts.master')
@section('head_title'){{__('Shipping Companies')}}@endsection
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
    </style>
@endpush
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Shipping Companies'),
        'route' =>  'shipping_companies.index',
    ],
],'button' => [
        'title' => __('Add Shipping Company'),
        'route' =>  'shipping_companies.create',
        'icon'  => 'plus'
]])

<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> @lang("Order Data") </h5>
                        <div class="heading-elements" style="display: flex;">
                            <?php $link = route('app.orders.print', $order->id); ?>
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
                                        <th {!! \table_width_head(6) !!}>@lang("Order ID")</th>
                                        <td>{{$order->id}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th {!! \table_width_head(6) !!}>@lang("Remaining date")</th>
                                        <td>{{$order->remaining_date ?? '----------'}}</td>
                                    </tr> --}}
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang("Order Owner")</th>
                                        <td>
                                            <table class="table table-bordered table-sm">
                                                <tr>
                                                    <th colspan="4" class="text-center">@lang('Information')</th>
                                                </tr>
                                                <tr>
                                                    <th>@lang('Name')</th>
                                                    <th>@lang('Email')</th>
                                                    <th>@lang('Phone')</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $order->user ? $order->user->name : __("No User Name Found")}}
                                                    </td>
                                                    @if($order->user)
                                                        <td>
                                                            <a href="mailto:{{ $order->user->email }}">
                                                                {{ $order->user->email ?? "-----------" }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="tel:{{ $order->user->phone }}">
                                                                {{ $order->user->phone ?? "-----------" }}
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td colspan="2">@lang("No User Phone Or Email Found")</td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th {!! \table_width_head(6) !!}>@lang("Vendor")</th>
                                        <td>
                                            <table class="table table-bordered table-sm">
                                                <tr>
                                                    <th colspan="4" class="text-center">@lang('Information')</th>
                                                </tr>
                                                <tr>
                                                    <th>@lang('Name')</th>
                                                    <th>@lang('Email')</th>
                                                    <th>@lang('Phone')</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $order->user ? $order->vendor->name : __("No Vendor Name Found")}}
                                                    </td>
                                                    @if($order->vendor)
                                                        <td>
                                                            <a href="mailto:{{ $order->vendor->email }}">
                                                                {{ $order->vendor->email ?? "-----------" }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="tel:{{ $order->vendor->phone }}">
                                                                {{ $order->vendor->phone ?? "-----------" }}
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td colspan="2">@lang("No User Phone Or Email Found")</td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang("Status")</th>
                                        <td>
                                            @if($order->status == Order::STATUS_FIFNISHED)
                                                @lang('Finished')
                                            @elseif($order->status == Order::STATUS_CANCEL)
                                                @lang('Canceled')
                                            @else
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <select class="select-search form-control" id="status" data-style="btn-default btn-lg" data-width="100%" name="status" data-order-id="{{$order->id}}">
                                                            <option value="0" disabled>@lang("Choose")</option>
                                                            @foreach($order_statuses as $order_status)
                                                                <option {{$order->status == $order_status ? 'selected' : ''}} value="{{$order_status}}">
                                                                    @lang($order_status ?? "-------")
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <span class="ajax-msg"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Payment Method')</th>
                                        <td>
                                            @lang($order->payment_method)
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Type')</th>
                                        <td>
                                            {{ __($order->type) ?? "----------" }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Booking Type')</th>
                                        <td>
                                            {{ __($order->booking_type) ?? "----------" }}
                                        </td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Period')</th>
                                        <td>
                                            <table class="table table-bordered table-sm">
                                                <tr>
                                                    <th colspan="4" class="text-center">@lang('Information')</th>
                                                </tr>
                                                <tr>
                                                    <th>@lang('Name')</th>
                                                    <th>@lang('From')</th>
                                                    <th>@lang('To')</th>
                                                </tr>
                                                <tr>
                                                    @if($order->period)
                                                        <td>
                                                            @lang($order->period->period)
                                                        </td>
                                                        <td>
                                                            {{ $order->period->from ?? "-----------" }}
                                                        </td>
                                                        <td>
                                                            {{ $order->period->to ?? "-----------" }}
                                                        </td>
                                                    @else
                                                        <td colspan="3">@lang("No Period Found")</td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Total Vat')</th>
                                        <td>
                                            {{ $order->total_vat}} {{ __(app_settings()->currency) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Total Application Ratio')</th>
                                        <td>
                                            {{ $order->total_application_ratio}} {{ __(app_settings()->currency) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Total Befor Vat And Application Ratio')</th>
                                        <td>
                                            {{ $order->total}} {{ __(app_settings()->currency) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Total After Vat And Application Ratio')</th>
                                        <td>
                                            {{ $order->total + $order->total_vat + $order->total_application_ratio }} {{ __(app_settings()->currency) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Amount Paid')</th>
                                        <td>
                                            {{ $order->amount_paid}} {{ __(app_settings()->currency) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Amount Remaining')</th>
                                        <td>
                                            {{ $order->amount_remaining}} {{ __(app_settings()->currency) }}
                                        </td>
                                    </tr> --}}
                                    {{-- @if($order->invoice_id)
                                        <tr>
                                            <th {!! \table_width_head(6) !!}>@lang('Invoice Id')</th>
                                            <td>
                                                {{ $order->invoice_id}}
                                            </td>
                                        </tr>
                                    @endif --}}
                                    {{-- @if($order->notes)
                                        <tr>
                                            <th {!! \table_width_head(6) !!}>@lang('Notes')</th>
                                            <td>
                                                {{ __($order->notes) ?? "----------" }}
                                            </td>
                                        </tr>
                                    @endif --}}
                                    {{-- @if ($orderServices->count())
                                        <tr>
                                            <th {!! \table_width_head(6) !!}>@lang("Services")</th>
                                            <td>
                                                <table class="table table-bordered table-sm">
                                                    <tr>
                                                        <th colspan="6" class="text-center">@lang('Information')</th>
                                                    </tr>
                                                    <tr>
                                                        <th>@lang('Name')</th>
                                                        <th>@lang('Main Price')</th>
                                                        <th>@lang('Fast Price')</th>
                                                        <th>@lang('Vip Price')</th>
                                                        <th>@lang('Discount')</th>
                                                        <th>@lang('Count Indiveduals')</th>
                                                    </tr>
                                                    <tr>
                                                        @forelse ($orderServices as $service)
                                                            <?php $count_indeviduals = \DB::table('order_services')->where('service_id', $service->id)->where('order_id', $order->id)->first(); ?>
                                                            <td>{{ $service->name }}</td>
                                                            <td>{{ $service->main_price }}</td>
                                                            <td>{{ $service->fast_price }}</td>
                                                            <td>{{ $service->discount }}</td>
                                                            <td>{{ $count_indeviduals->count }}</td>
                                                        @empty
                                                            <td colspan="6" class="text-center">@lang("No Services Found")</td>
                                                        @endforelse
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($orderOffers->count())
                                        <tr>
                                            <th {!! \table_width_head(6) !!}>@lang("Services")</th>
                                            <td>
                                                <table class="table table-bordered table-sm">
                                                    <tr>
                                                        <th colspan="4" class="text-center">@lang('Information')</th>
                                                    </tr>
                                                    <tr>
                                                        <th>@lang('Name')</th>
                                                        <th>@lang('Main Price')</th>
                                                        <th>@lang('Fast Price')</th>
                                                        <th>@lang('Vip Price')</th>
                                                    </tr>
                                                    <tr>
                                                        @forelse ($orderOffers as $offer)
                                                            <td>{{ $offer->name }}</td>
                                                            <td>{{ $offer->main_price }}</td>
                                                            <td>{{ $offer->fast_price }}</td>
                                                        @empty
                                                            <td colspan="4" class="text-center">@lang("No Offers Found")</td>
                                                        @endforelse
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif --}}
                                    <tr>
                                        <th {!! \table_width_head(6) !!}>@lang('Address')</th>
                                        <td>
                                            @if ($order->address)
                                                {{$order->address}}
                                            @else
                                                ----------
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Geographical location")</th>
                                        <td><div id="mapi" style="height:300px;"></div></td>
                                    </tr> --}}
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
@push('scripts')
{{-- <script type="text/javascript"
        src="//maps.google.com/maps/api/js?key={{env('MAP_KEY')}}&sensor=false&libraries=places&language=ar">
    </script> --}}
    <!-- map -->
    {{-- <script>
        var mapDiv = document.getElementById('mapi');
        var geocoder = new google.maps.Geocoder;
        var infoWindow = new google.maps.InfoWindow;
        // Set the Map
        var itemlat = parseFloat("{{ $order->lat ?? '24.69023' }}");
        var itemlng = parseFloat("{{ $order->lng ?? '46.685' }}");
        var map = new google.maps.Map(mapDiv, {
            center: {
                lat: itemlat,
                lng: itemlng
            },
            zoom: 10
        });
        // Set the Markers
        var marker = new google.maps.Marker({
            position: {
                lat: itemlat,
                lng: itemlng
            },
            map: map,
            icon: "{{ asset('assets/marker.png') }}",
            draggable: true,
            animation: google.maps.Animation.xo
        });
    </script> --}}
    <script>
        $('#status').change(function (e) {
            var el = $(this);
            var parent = el.parent();
            $.ajax({
                url: _url_+"app/orders-change-status",
                method: 'GET',
                beforeSend: function (xhr) {
                    $('.ajax-msg').fadeIn();
                    $('.ajax-msg').addClass("changeStatus");
                    $('.ajax-msg').html('@lang('Wait ...')');
                },
                data: {
                    order_id: el.data('order-id'),
                    status: el.val()
                }
            }).done(function (res) {
                if (res.status === true) {
                    var msg = "@lang('Change Status Done')"
                    $('.ajax-msg').addClass("changeStatus");
                    $('.ajax-msg').html(msg).delay(5000).fadeOut();
                }
            });
        });
    </script>
@endpush
