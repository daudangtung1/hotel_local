<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên dịch vụ</th>
        <th>Tên phòng</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
        <th>Ngày tạo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookingRoomServices as $bookingRoomService)
        <tr>
            <td>{{ $bookingRoomService->id }}</td>
            <td>{{ $bookingRoomService->service->name ?? 'Không tồn tại' }}</td>
            <td>{{ $bookingRoomService->bookingRoom->room->name ?? 'Không tồn tại' }}</td>
            <td>{{ number_format($bookingRoomService->quantity) }}</td>
            <td>{{ number_format($bookingRoomService->price) }}</td>
            <td>{{ number_format($bookingRoomService->quantity * $bookingRoomService->price) }}</td>
            <td>{{ \Carbon\Carbon::parse($bookingRoomService->created_at)->format('Y-m-d H:i:s') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
