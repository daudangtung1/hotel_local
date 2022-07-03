<div class="col-md-12">
    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="filter">
            <form action="{{route('reports.index')}}" class="d-flex" method="GET">
                <input type="text" name="s" id="s" class="form-control me-2" placeholder="Từ khóa" value="@if(!empty(request()->s)) {{request()->s}} @endif">
                <select class="form-control me-2" name="status">
                    <option value="">Loại phòng</option>
                    @foreach(\App\Models\Room::ARRAY_STATUS as $key => $status)
                        <option @if(!empty(request()->status) && request()->status == $key) selected @endif value="{{$key}}">{{$status}}</option>
                    @endforeach
                </select>
                <input type="text" class="form-control me-2 filter-date" placeholder="Ngày bắt đầu" name="start_date" value="@if(!empty(request()->start_date)) {{request()->start_date}} @endif"  autocomplete="false">
                <input type="text" class="form-control me-2 filter-date" placeholder="Ngày kết thúc" name="end_date" value="@if(!empty(request()->end_date)) {{request()->end_date}} @endif" autocomplete="false">
                <input type="hidden" name="by" value="{{request()->by ?? ''}}">
                <button class="btn btn-success me-2">Lọc</button>
                <button class="btn btn-danger" type="submit" name="export" style=" white-space: nowrap;" value="export" >Xuất Excel</button>
            </form>
        </div>
    </div>
    <table class="table table-sm table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên phòng</th>
            <th scope="col">Tầng</th>
            <th scope="col">Ngày nhận phòng</th>
            <th scope="col">Ngày trả phòng</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Ghi chú</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($items))
            @forelse($items as $key => $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->room->name ?? '-'}}</td>
                    <td>{{$item->room->floor ?? '-'}}</td>
                    <td>{{$item->start_date ?? '-'}}</td>
                    <td>{{$item->end_date ?? '-'}}</td>
                    <td>
                        @foreach($item->bookingRoomCustomers()->get() as $customer)
                            <p>{{$customer->customer->name ?? '-'}}</p>
                        @endforeach
                    </td>
                    <td>{{$item->note ?? '-'}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Không có phòng nào</td>
                </tr>
            @endforelse
        @else
            <tr>
                <td colspan="7">Không có phòng nào</td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-2 mb-2">
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
</div>
