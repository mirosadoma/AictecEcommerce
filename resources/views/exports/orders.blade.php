<table>
    <thead>
    <tr>
        <th>@lang("ID")</th>
        <th>@lang("Number")</th>
        <th>@lang("User")</th>
        <th>@lang("Address")</th>
        <th>@lang("Coupon")</th>
        <th>@lang("Payment Method")</th>
        <th>@lang("Status")</th>
        <th>@lang("Sub Total")</th>
        <th>@lang("Tax")</th>
        <th>@lang("Grand Total")</th>
        <th>@lang("Discount")</th>
        <th>@lang("Payment Total")</th>
        <th>@lang("Wallet")</th>
        <th>@lang("Delivery Charge")</th>
        <th>@lang("Final Total")</th>
        <th>@lang("Cancel Reson")</th>
        <th>@lang("Installation Service")</th>
        <th>@lang("Created At")</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_data as $value)
        <tr>
            <td>{{ $value['id'] }}</td>
            <td>{{ $value['number'] }}</td>
            <td>{{ $value['user'] }}</td>
            <td>
                <ul>
                    @foreach ($value['address'] as $address)
                        <li>{{$address}}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <ul>
                    @foreach ($value['coupon'] as $coupon)
                        <li>{{$coupon}}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $value['payment_method'] }}</td>
            <td>{{ $value['status'] }}</td>
            <td>{{ $value['sub_total'] }}</td>
            <td>{{ $value['tax'] }}</td>
            <td>{{ $value['grand_total'] }}</td>
            <td>{{ $value['discount'] }}</td>
            <td>{{ $value['payment'] }}</td>
            <td>{{ $value['wallet'] }}</td>
            <td>{{ $value['delivery_charge'] }}</td>
            <td>{{ $value['final_total'] }}</td>
            <td>{{ $value['cancel_reson'] }}</td>
            <td>{{ $value['installation_service'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
