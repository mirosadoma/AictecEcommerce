<table>
    <thead>
    <tr>
        <th>#</th>
        <th>@lang('Category')</th>
        <th>@lang('Product')</th>
        <th>@lang('Quantity')</th>
    </tr>
    </thead>
    <tbody>
        @php
            $n = 1;
        @endphp
        @foreach($all_data as $value)
            <tr>
                <td>
                    {{ $n }}
                </td>
                <td>
                    {{ $value['category']??"-----"}}
                </td>
                <td>
                    {{ $value['product']??"-----"}}
                </td>
                <td>
                    {{ $value['quantity']??"-----"}}
                </td>
            </tr>
            @php
                $n++;
            @endphp
        @endforeach
    </tbody>
</table>
