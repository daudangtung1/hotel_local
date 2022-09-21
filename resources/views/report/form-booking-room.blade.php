<div class="col-md-12">
    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="filter">
            <form action="{{route('reports.index')}}" class="d-flex" method="GET">
                <input type="text" name="s" id="s" class="form-control form-control-sm me-2" placeholder="Từ khóa" value="@if(!empty(request()->s)) {{request()->s}} @endif">
                <select class="form-control form-control-sm me-2" name="status">
                    <option value="">Loại phòng</option>
                    @foreach(\App\Models\Room::ARRAY_STATUS as $key => $status)
                        <option @if(!empty(request()->status) && request()->status == $key) selected @endif value="{{$key}}">{{$status}}</option>
                    @endforeach
                </select>
                <input type="text" class="form-control form-control-sm me-2 filter-date" placeholder="Ngày bắt đầu" name="start_date" value="@if(!empty(request()->start_date)) {{request()->start_date}} @endif"  autocomplete="off">
                <input type="text" class="form-control form-control-sm me-2 filter-date" placeholder="Ngày kết thúc" name="end_date" value="@if(!empty(request()->end_date)) {{request()->end_date}} @endif" autocomplete="off">
                <input type="hidden" name="by" value="{{request()->by ?? ''}}">
                <button class="btn btn-success me-2  d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                    </svg>Lọc</button>
                <button class="btn btn-danger d-flex align-items-center" type="submit" name="export" style=" white-space: nowrap;" value="export" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                        <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    </svg>Xuất Excel</button>
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
                    <td colspan="7">Không có dữ liệu</td>
                </tr>
            @endforelse
        @else
            <tr>
                <td colspan="7">Không có dữ liệu</td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-2 mb-2">
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
</div>
