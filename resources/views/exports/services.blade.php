<table>
    <thead>
        <tr>
            <th>{{__('ID')}}</th>
            <th>{{__('Service_name')}}</th>
            <th>{{__('Inventory')}}</th>
            <th>{{__('Unit_price')}}</th>
            <th>{{__('Service_type')}}</th>
            <th>{{__('Creator')}}</th>
            <th>{{__('Created_date')}}</th>
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
            <td>{{ $service->user->name ?? __('Not_exist') }}</td>
            <td>{{ \Carbon\Carbon::parse($service->created_at)->format('Y-m-d H:i:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
