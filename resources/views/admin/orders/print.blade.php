<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>{{ $order->id }}</title>
    <style>
        body {
            background-color: #999;
            font-family: Arial, Helvetica, sans-serif;
            height: 100vh;
        }

        .bill-cont {
            width: 613px;
            margin: 20px auto;
            background-color: #fff;
            padding: 15px 0;
        }

        .bill-head {
            margin-bottom: 25px;
        }

        .main-title {
            color: #000;
            font-weight: bold;
            text-transform: uppercase;
            margin: auto;
            text-align: center;
            margin: 0;
            margin-bottom: 5px;
        }

        .main-desc {
            margin: 0;
            margin: auto;
            text-align: center;
        }

        .bud td{
            border-top: 1px dashed #000;
        }

        .table-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 10px;
            margin-bottom: 15px;
        }

        .table-sub {
            margin: 0;
        }

        table.items {
            width: 100%;
            text-align: center;
        }

        table th {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 15px 0;
        }

        table th:first-of-type {
            width: 15%;
        }

        table th:nth-of-type(2) {
            width: 15%;
        }

        table th:nth-of-type(3) {
            width: 20%;
        }

        table th:nth-of-type(4) {
            width: 20%;
        }

        table td {
            padding: 15px 10px;
        }

        table td:first-child {
            text-align: left;
        }

        html[dir=rtl] table td:first-child {
            text-align: right;
        }

        .sub-total td {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 15px 10px;
        }

        table.desc {
            width: 100%;
            text-align: right;
        }

        html[dir=rtl] table.desc {
            text-align: left;
        }

        table.desc tr {
            display: flex;
            align-items: center;
        }

        table.desc td:first-child {
            width: 75%;
            text-align: right;
            font-size: 12px;
        }

        html[dir=rtl] table.desc td:first-child {
            text-align: right;
        }

        table.desc td:last-child {
            width: 25%;
            text-align: right;
            font-size: 12px;
        }

        html[dir=rtl] table.desc td:last-child {
            text-align: center;
        }

        .total td {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 15px 10px;
            font-size: 19px !important;
            font-weight: bolder;
            text-align: left !important;
        }

        html[dir=rtl] .total td {
            text-align: right !important;
        }

        html[dir=rtl] .total td:last-child {
            text-align: center !important;
        }

        .name-bill {
            margin: 0;
            text-align: right;
            margin-left: auto;
            margin-right: 10px;
            text-transform: uppercase;
            margin-top: 50px;
            font-size: 13px;
        }

        html[dir=rtl] .name-bill {
            text-align: left;
            margin-right: auto;
            margin-left: 10px;
        }

        .thanks {
            width: 100%;
            margin-top: 10px;
            align-items: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
        }

        .thanks span {
            font-size: 12px;
            font-weight: bold;
        }

        .thanks img {
            margin-top: 6px;
            width: 75px;
        }

        @page {
            size: auto;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="bill-cont">
    <div class="bill-head">
        <h3 class="main-title">{{ $order->user->name ?? __('Guest') }}</h3>
        <p class="main-desc">@lang('User Phone'):{{ $order->user->phone ?? "----------" }} </p>
        <p class="main-desc">@lang('User Email'):{{ $order->user->email ?? "----------" }} </p>
        <p class="main-desc">@lang('User Address'):{{ $order->user->address ?? '' }} </p>
        <?php $link = 'https://www.google.com/maps/dir/?api=1&destination=' . $order->lat . ',' . $order->lng;?>
        <p style="display: block; text-align: center; direction: ltr; margin: 0 0 10px 0;">
            <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl={{urlencode($link)}}" alt="">
            {{-- <br>
            <a href="{{$link}}">{{$link}}</a> --}}
        </p>
        <p class="main-desc">@lang('Order Address'):{{ $order->address ?? "----------" }} </p>
        <p class="main-desc">@lang('Invoice Id'):{{ $order->invoice_id }} </p>
    </div>
    <div class="table-head">
        <p class="table-sub"><b>@lang('Order ID') : </b> <span>{{ $order->id }}</span></p>
        <p class="table-sub"><b>@lang('Remaining date') : </b> <span>{{ $order->remaining_date }}</span></p>
    </div>
    <div class="table-head">
        <p class="table-sub"><b>@lang('Payment Type') : </b> <span>{{ __($order->payment_type) ?? "----------" }}</span></p>
        <p class="table-sub"><b>@lang('Type') : </b> <span>{{ __($order->type) ?? "----------" }}</span></p>
    </div>
    <div class="table-head">
        <p class="table-sub"><b>@lang('Booking Type') : </b> <span>
        @if($order->booking_type == "main_price")
            {{__("Normal")}}
        @elseif($order->booking_type == "fast_price")
            {{__("Fast")}}
        @else
            ----------
        @endif
        </span></p>
        {{-- <p class="table-sub"><b>@lang('Booking Type') : </b> <span>{{ __($order->booking_type) ?? "----------" }}</span></p> --}}
        <p class="table-sub"><b>@lang('Period') : </b> <span>{{ __($order->period->period) ?? "----------" }}</span></p>
    </div>
    {{-- Start Services --}}
    @if ($orderServices->count())
        <div class="bill-head">
            <p class="main-desc">
                <b style="text-decoration: underline">@lang("Services")</b>
            </p>
        </div>
        <table class="items">
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('Price')</th>
                <th>@lang('Discount')</th>
                <th>@lang('Count Indiveduals')</th>
            </tr>
            @forelse ($orderServices as $service)
                <?php $count_indeviduals = \DB::table('order_services')->where('service_id', $service->id)->where('order_id', $order->id)->first(); ?>
                <td>{{ $service->name }}</td>
                <td>
                    @if ($order->booking_type == "main_price")
                        {{$service->main_price}}
                    @elseif($order->booking_type == "fast_price")
                        {{$service->fast_price}}
                    {{-- @elseif($order->booking_type == "vip_price")
                        {{$service->vip_price}} --}}
                    @endif
                </td>
                <td>{{ $service->discount }}</td>
                <td>{{ $count_indeviduals->count }}</td>
            @empty
                <td colspan="4" class="text-center">@lang("No Services Found")</td>
            @endforelse
        </table>
    @endif
    {{-- End Services --}}
    {{-- Start Offers --}}
    @if ($orderOffers->count())
        <div class="bill-head">
            <p class="main-desc">
                <b style="text-decoration: underline">@lang("Offers")</b>
            </p>
        </div>
        <table class="items">
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('Price')</th>
            </tr>
            @forelse ($orderOffers as $offer)
                <td>{{ $offer->name }}</td>
                <td>
                    @if ($order->booking_type == "main_price")
                        {{$offer->main_price}}
                    @elseif($order->booking_type == "fast_price")
                        {{$offer->fast_price}}
                    {{-- @elseif($order->booking_type == "vip_price")
                        {{$offer->vip_price}} --}}
                    @endif
                </td>
            @empty
                <td colspan="2" class="text-center">@lang("No Offers Found")</td>
            @endforelse
        </table>
    @endif
    {{-- End Offers --}}
    <hr style="border-style: solid;">
    <table class="items">
        <tr class="bud">
            <td colspan="3">@lang('Total')</td>
            <td>{{ $order->total ?? "0" }}{{ app_settings()->currency }} </td>
        </tr>
        <tr class="bud">
            <td colspan="3">@lang('Total Vat')</td>
            <td>{{ $order->total_vat ?? "0" }} {{ app_settings()->currency }}</td>
        </tr>
        <tr class="bud">
            <td colspan="3">@lang('Total Application Ratio')</td>
            <td>{{ $order->total_application_ratio ?? "0" }} {{ app_settings()->currency }}</td>
        </tr>
        <tr class="bud">
            <td colspan="3">@lang('Amount Paid')</td>
            <td>{{ $order->amount_paid ?? "0" }} {{ app_settings()->currency }}</td>
        </tr>
        <tr class="bud">
            <td colspan="3">@lang('Amount Remaining')</td>
            <td>{{ $order->amount_remaining ?? "0" }} {{ app_settings()->currency }}</td>
        </tr>
    </table>
    <div class="thanks">
        <span>@lang('Thank you')</span>
        <span>{{ app_settings()->address }}</span>
        <span>{{ app_settings()->email }}</span>
        <span>{{ app_settings()->phone }}</span>
        <img src="{{ app_settings()->bill_logo_path }}" style="padding: 10px;width: 100px;" alt="@lang('Admin Logo')">
    </div>
</div>
</body>
</html>
