<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên dịch vụ</th>
            <th>Tồn kho</th>
            <th>Đơn giá</th>
            <th>Loại dịch vụ</th>
            <th>Người tạo</th>
            <th>Ngày tạo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{ $service->id }}</td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->stock }}</td>
            <td>{{ $service->price }}</td>
            <td>{{ \App\Models\Service::ARRAY_SERVICE_TYPE[$service->type] }}</td>
            <td>{{ $service->user->name ?? 'Không tồn tại' }}</td>
            <td>{{ \Carbon\Carbon::parse($service->created_at)->format('Y-m-d H:i:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
