<table>
    <thead>
    <tr>
        <th>@lang("ID")</th>
        <th>@lang("Email")</th>
        <th>@lang("Created At")</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_data as $value)
        <tr>
            <td>{{ $value['id'] }}</td>
            <td>{{ $value['email'] }}</td>
            <td>{{ $value['created_at'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
