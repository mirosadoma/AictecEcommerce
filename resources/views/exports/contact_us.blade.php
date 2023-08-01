<table>
    <thead>
    <tr>
        <th>@lang("ID")</th>
        <th>@lang("Name")</th>
        <th>@lang("Email")</th>
        <th>@lang("Phone")</th>
        <th>@lang("Message")</th>
        <th>@lang("Created At")</th>
        <th>@lang("Reply")</th>
        <th>@lang("Reply Date")</th>
        <th>@lang("Reply Time")</th>
        <th>@lang("Reply Owner")</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_data as $value)
        <tr>
            <td>{{ $value['id'] }}</td>
            <td>{{ $value['name'] }}</td>
            <td>{{ $value['email'] }}</td>
            <td>{{ $value['phone'] }}</td>
            <td>{{ $value['message'] }}</td>
            <td>{{ $value['created_at'] }}</td>
            <td>{{ $value['reply'] }}</td>
            <td>{{ $value['reply_date'] }}</td>
            <td>{{ $value['reply_time'] }}</td>
            <td>{{ $value['reply_owner'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
