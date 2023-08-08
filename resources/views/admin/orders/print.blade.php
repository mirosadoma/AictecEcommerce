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

        .thanks p {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
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
        <h3 class="main-title">{{ $order->user->name ?? "" }}</h3>
        <p class="main-desc">@lang('Phone'):{{ $order->user->phone ?? "----------" }} </p>
        <p class="main-desc">@lang('Email'):{{ $order->user->email ?? "----------" }} </p>
        {{-- <p class="main-desc">@lang('Address'):{{ $order->address-> ?? '' }} </p> --}}
        <?php $link = 'https://www.google.com/maps/dir/?api=1&destination=' . $order->address->lat . ',' . $order->address->lng;?>
        <p style="display: block; text-align: center; direction: ltr; margin: 0 0 10px 0;">
            <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl={{urlencode($link)}}" alt="">
            <br>
            <a href="{{$link}}">{{$link}}</a>
        </p>
    </div>
    <table class="items">
        <tr class="bud">
            <td  style="text-align: right;padding: 15px 20px 0;">
                <div class="table-head">
                    <p class="table-sub"><b>@lang('Order ID') : </b> <span>{{ $order->id }}</span></p><br>
                </div>
            </td>
            <td  style="text-align: right;padding: 15px 20px 0;">
                <div class="table-head">
                    <p class="table-sub"><b>@lang('Payment Method') : </b> <span>{{ __($order->payment_method) ?? "----------" }}</span></p><br>
                </div>
            </td>
        </tr>
        <tr>
            <td  style="text-align: right;padding: 0 20px;">
                <div class="table-head">
                    <p class="table-sub"><b>@lang('Order Number') : </b> <span>{{ $order->number }}</span></p>
                </div>
            </td>
            <td  style="text-align: right;padding: 0 20px;">
                <div class="table-head">
                    <p class="table-sub"><b>@lang('Status') : </b> <span>{{ __(\App\Models\Orders\Order::getOrderStatuses($order->status)) ?? "----------" }}</span></p>
                </div>
            </td>
        </tr>
    </table>
    {{-- Start Products --}}
    <hr style="border-style: solid;">
    @if ($order->products->count())
        <div class="bill-head">
            <p class="main-desc">
                <b style="text-decoration: underline">@lang("Products")</b>
            </p>
        </div>
    @endif
    <table class="items">
        <tr class="bud">
            <td  style="text-align: right;padding-right: 40px">@lang('Name')</td>
            <td  style="text-align: right;padding-right: 40px">@lang('Price')</td>
            <td  style="text-align: right;padding-right: 40px">@lang('Quantity')</td>
        </tr>
        <tr>
            @forelse ($order->products as $product)
                <td style="text-align: right;padding-right: 40px">{{ $product->title }}</td>
                <td style="text-align: right;padding-right: 40px">{{ $product->price }}</td>
                <td style="text-align: right;padding-right: 40px">{{ $product->quantity }}</td>
            @empty
                <td colspan="2" class="text-center">@lang("Not Founded")</td>
            @endforelse
        </tr>
    </table>
    {{-- End Products --}}
    <hr style="border-style: solid;">
    <div class="bill-head">
        <p class="main-desc">
            <b style="text-decoration: underline">@lang("Details")</b>
        </p>
    </div>
    <table class="items">
        <tr class="bud">
            <td  style="text-align: right;padding-right: 40px" colspan="3">@lang('Sub Total')</td>
            <td  style="text-align: center">{{ $order->sub_total ?? "0" }}<span style="color:red"> @lang('Riyal Saudi')  </span></td>
        </tr>
        <tr class="bud">
            <td  style="text-align: right;padding-right: 40px" colspan="3">@lang('Tax')</td>
            <td  style="text-align: center">{{ $order->tax ?? "0" }} <span style="color:red"> @lang('Riyal Saudi') </span></td>
        </tr>
        <tr class="bud">
            <td  style="text-align: right;padding-right: 40px" colspan="3">@lang('Grand Total')</td>
            <td  style="text-align: center">{{ $order->grand_total ?? "0" }} <span style="color:red"> @lang('Riyal Saudi') </span></td>
        </tr>
        <tr class="bud">
            <td  style="text-align: right;padding-right: 40px" colspan="3">@lang('Discount')</td>
            <td  style="text-align: center">{{ $order->discount ?? "0" }} <span style="color:red"> @lang('Riyal Saudi') </span></td>
        </tr>
        <tr class="bud">
            <td  style="text-align: right;padding-right: 40px" colspan="3">@lang('Payment Total')</td>
            <td  style="text-align: center">{{ $order->payment ?? "0" }} <span style="color:red"> @lang('Riyal Saudi') </span></td>
        </tr>
        <tr class="bud">
            <td  style="text-align: right;padding-right: 40px" colspan="3">@lang('Wallet')</td>
            <td  style="text-align: center">{{ $order->wallet ?? "0" }} <span style="color:red"> @lang('Riyal Saudi') </span></td>
        </tr>
        <tr class="bud">
            <td  style="text-align: right;padding-right: 40px" colspan="3">@lang('Delivery Charge')</td>
            <td  style="text-align: center">{{ $order->delivery_charge ?? "0" }} <span style="color:red"> @lang('Riyal Saudi') </span></td>
        </tr>
        <tr class="bud">
            <td  style="text-align: right;padding-right: 40px" colspan="3">@lang('Final Total')</td>
            <td  style="text-align: center">{{ $order->final_total ?? "0" }} <span style="color:red"> @lang('Riyal Saudi') </span></td>
        </tr>
    </table>
    <div class="thanks">
        <p>@lang('Thank You')</p>
        <p>{{ app_settings()->address }}</p>
        <p>{{ app_settings()->email }}</p>
        <p>{{ app_settings()->full_phone }}</p>
    </div>
</div>
</body>
</html>
