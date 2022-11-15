<table>
    <thead>
    <tr>
        <th>{{__('ID')}}</th>
        <th>{{__('Service_name')}}</th>
        <th>{{__('Room_name')}}</th>
        <th>{{__('Amount')}}</th>
        <th>{{__('Unit_price')}}</th>
        <th>{{__('Into_money')}}</th>
        <th>{{__('Created_date')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookingRoomServices as $bookingRoomService)
        <tr>
            <td>{{ $bookingRoomService->id }}</td>
            <td>{{ $bookingRoomService->service->name ?? __('Not_exist') }}</td>
            <td>{{ $bookingRoomService->bookingRoom->room->name ?? __('Not_exist') }}</td>
            <td>{{ number_format($bookingRoomService->quantity) }}</td>
            <td>{{ number_format($bookingRoomService->price) }}</td>
            <td>{{ number_format($bookingRoomService->quantity * $bookingRoomService->price) }}</td>
            <td>{{ \Carbon\Carbon::parse($bookingRoomService->created_at)->format('Y-m-d H:i:s') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
