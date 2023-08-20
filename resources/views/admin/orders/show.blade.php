<?php
use App\Models\Orders\Order;
$order_statuses = [
    Order::STATUS_PAYMENTPENDDING,
    Order::STATUS_PAID,
    Order::STATUS_IN_PROCESS,
    Order::STATUS_ASSIGNED,
    Order::STATUS_DELIVERED,
    Order::STATUS_CANCELLED,
];
?>
@extends('admin.layouts.master')
@section('head_title'){{__('Orders')}}@endsection
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
        'name'  =>  __('Orders'),
        'route' =>  'orders.index',
    ],
    [
        'name'  =>  __('Show'),
        'route' =>  'orders.show',
    ],
],'button' => [
        'title' => __('Back To Orders'),
        'route' =>  'orders.index',
        'icon'  => 'arrow-left'
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
                            <?php $link = route('app.order_print', $order->id); ?>
                            <a class="btn btn-primary" onClick="MyWindow=window.open('{!! $link !!}','MyWindow','width=1000,height=500'); return false;" type="button" class="btn btn-dark legitRipple">
                               @lang('Print')
                            </a>
                            <a class="btn btn-warning" style="margin: 0 10px;" href="{{route('app.order_export_pdf', $order->id)}}" type="button" class="btn btn-dark legitRipple">
                               @lang('Export PDF')
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <fieldset>
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Order ID")</th>
                                        <td>{{$order->id}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Order Number")</th>
                                        <td>{{$order->number}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Order Owner")</th>
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
                                                        <td colspan="3">@lang("No User Phone Or Email Found")</td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Address")</th>
                                        <td>
                                            <table class="table table-bordered table-sm">
                                                <tr>
                                                    <th colspan="10" class="text-center">@lang('Information')</th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;">@lang('ID')</th>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;"">@lang('User Name')</th>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;">@lang('Full Name')</th>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;">@lang('Phone')</th>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;">@lang('Street Address')</th>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;">@lang('Building Number')</th>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;">@lang('Floor Number')</th>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;">@lang('Postal Code')</th>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;">@lang('City')</th>
                                                    <th style="width: 150px; padding: 5px 0 !important; margin: 0 !important; text-align: center; vertical-align: middle;">@lang('District')</th>
                                                </tr>
                                                <tr>
                                                    @if($order->address)
                                                        <td>{{ $order->address->id??'#'}} </td>
                                                        <td>{{ $order->address->user ? $order->address->user->name : __("No User Name Found")}}</td>
                                                        <td>{{ $order->address->full_name ?? "-----------" }}</td>
                                                        <td>
                                                            <a href="tel:{{ $order->address->phone }}">
                                                                {{ $order->address->phone ?? "-----------" }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $order->address->street_address ?? "-----------" }}</td>
                                                        <td>{{ $order->address->building_number ?? "-----------" }}</td>
                                                        <td>{{ $order->address->floor_number ?? "-----------" }}</td>
                                                        <td>{{ $order->address->postal_code ?? "-----------" }}</td>
                                                        <td>{{ $order->address->city->name ?? "-----------" }}</td>
                                                        <td>{{ $order->address->district ?? "-----------" }}</td>
                                                    @else
                                                        <td colspan="10">@lang("No Data Founded")</td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Status")</th>
                                        <td>
                                            @if($order->status == Order::STATUS_DELIVERED)
                                                @lang('Delivered')
                                            @elseif($order->status == Order::STATUS_CANCELLED)
                                                @lang('Cancelled')
                                            @else
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <select class="select-search form-control" id="status" data-style="btn-default btn-lg" data-width="100%" name="status" data-order-id="{{$order->id}}">
                                                            <option value="0" disabled>@lang("Choose")</option>
                                                            @foreach($order_statuses as $order_status)
                                                                <option {{$order->status == $order_status ? 'selected' : ''}} value="{{$order_status}}">
                                                                    @lang(Order::getOrderStatuses($order_status) ?? "-------")
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <span class="ajax-msg"></span>
                                        </td>
                                    </tr>
                                    <tr class="cancel_reson" @if($order->status != Order::STATUS_CANCELLED) style="display: none" @endif>
                                        <th {!! \table_width_head(8) !!}>@lang('Cancel Reson')</th>
                                        <td>
                                            {{$order->cancel_reson ? __($order->cancel_reson) : '-------------' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Payment Method')</th>
                                        <td>
                                            @lang($order->payment_method)
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Coupon')</th>
                                        <td>
                                            {{$order->coupon->name}}  |  {{$order->coupon->code}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Installation Service')</th>
                                        <td>
                                            {{($order->installation_service == 1) ? __('Yes') : __('No')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Sub Total')</th>
                                        <td>
                                            {{ $order->sub_total}} <span style="color:red">@lang('Riyal Saudi')</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Tax')</th>
                                        <td>
                                            {{ $order->tax}} <span style="color:red">@lang('Riyal Saudi')</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Grand Total')</th>
                                        <td>
                                            {{ $order->grand_total}} <span style="color:red">@lang('Riyal Saudi')</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Discount')</th>
                                        <td>
                                            {{ $order->discount }} <span style="color:red">@lang('Riyal Saudi')</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Payment Total')</th>
                                        <td>
                                            {{ $order->payment}} <span style="color:red">@lang('Riyal Saudi')</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Wallet')</th>
                                        <td>
                                            {{ $order->wallet}} <span style="color:red">@lang('Riyal Saudi')</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Delivery Charge')</th>
                                        <td>
                                            {{ $order->delivery_charge}} <span style="color:red">@lang('Riyal Saudi')</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang('Final Total')</th>
                                        <td>
                                            {{ $order->final_total}} <span style="color:red">@lang('Riyal Saudi')</span>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Geographical location")</th>
                                        <td><div id="mapi" style="height:300px;"></div></td>
                                    </tr> --}}
                                    <tr>
                                        <th {!! \table_width_head(8) !!}>@lang("Products")</th>
                                        <td>
                                            <table class="table table-bordered table-sm">
                                                <tr>
                                                    <th colspan="4" class="text-center">@lang('Information')</th>
                                                </tr>
                                                <tr>
                                                    <th>@lang('Image')</th>
                                                    <th>@lang('Name')</th>
                                                    <th>@lang('Price')</th>
                                                    <th>@lang('Quantity')</th>
                                                </tr>
                                                <tr>
                                                    @if($order->order_products)
                                                        @foreach ($order->order_products as $order_product)
                                                            <td><img src="{{$order_product->product->main_image_path}}" style="width: 80px"></td>
                                                            <td>{{$order_product->product->title}}</td>
                                                            <td>{{$order_product->price}}</td>
                                                            <td>{{$order_product->quantity}}</td>
                                                        @endforeach
                                                    @else
                                                        <td colspan="4">@lang("No Data No Data Founded")</td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
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
            $('.cancel_reson').hide();
            var el = $(this);
            var parent = el.parent();
            var url = _url_+"app/order_change_status";
            $.ajax({
                url: _url_+"app/order_change_status",
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
                    $('.ajax-msg').addClass("changeStatus");
                    $('.ajax-msg').html(res.msg).delay(5000).fadeOut();
                }else{
                    $('.ajax-msg').addClass("errorStatus");
                    $('.ajax-msg').html(res.msg).delay(5000).fadeOut();
                }
            });
            if (el.val() == 'cancelled') {
                $('.cancel_reson').show();
            }
        });
    </script>
@endpush
