<div class="col-md-12">
    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="filter">
            <form action="{{route('reports.index')}}" class="d-flex" method="GET">
                <input type="text" name="s" id="s" class="form-control form-control-sm me-2" placeholder="Tìm kiếm theo phòng" value="@if(!empty(request()->s)){{request()->s}}@endif"  autocomplete="off">
                <select class="form-control form-control-sm me-2" name="services">
                    <option value="">Dịch vụ</option>
                    @foreach($services as $key => $service)
                        <option @if(!empty(request()->service_id) && request()->serviceid == $service->id) selected @endif value="{{$service->id}}">{{$service->name ?? ''}}</option>
                    @endforeach
                </select>
                <input type="text" class="form-control form-control-sm me-2 filter-date" placeholder="Ngày bắt đầu thuê" name="date" value="@if(!empty(request()->date)) {{request()->date}} @endif"  autocomplete="off">
                <input type="hidden" name="by" value="{{request()->by ?? ''}}">
                <button class="btn btn-success me-2  d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                    </svg>Lọc</button>
            </form>
        </div>
    </div>
    <table class="table table-sm table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Phòng</th>
            <th>Tên dịch vụ</th>
            <th>Giá</th>
            <th>Số lượng/ngày thuê</th>
            <th>Tổng tiền</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($bookingRoomServices))
            @forelse($bookingRoomServices as $key => $bookingRoomService)
                <tr>
                    <td>{{$bookingRoomService->id}}</td>
                    <td>
                        <p><b>Phòng</b> {{$bookingRoomService->bookingRoom->room->name ?? ''}}</p>
                        <p><b>Tầng:</b> {{$bookingRoomService->bookingRoom->room->floor ?? ''}}</p>
                        <p><b>Ngày thuê phòng:</b> {{$bookingRoomService->bookingRoom->start_date ?? ''}}</p>
                    </td>
                    <td>
                        <p><b>{{$bookingRoomService->service->name ?? '-'}}</b></p>
                        <p><b>Ngày đặt:</b> {{$bookingRoomService->created_at ?? '-'}}</p>
                    </td>
                    <td>{{get_price($bookingRoomService->price ?? 0, 'đ')}}</td>
                    <td>
                        @if($bookingRoomService->start_date)
                            <p><b>Bắt đầu:</b> {{$bookingRoomService->start_date}}</p>
                            <p><b>Kết thúc:</b> {{$bookingRoomService->end_date}}</p>
                            <p><b>Tổng:</b> {{$bookingRoomService->getTotalDate(true)}}</p>
                        @else
                            <p><b>Số lượng:</b> {!! $bookingRoomService->quantity ??0 !!}</p>
                        @endif
                    </td>
                    <td>
                        @if($bookingRoomService->start_date)
                            {{get_price(($bookingRoomService->price ?? 0) * $bookingRoomService->getTotalDate(), 'đ') ??''}}
                        @else
                            {{get_price(($bookingRoomService->price ?? 0) * ($bookingRoomService->quantity ?? 0), 'đ') ??''}}
                        @endif

                    </td>
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
        {{ $bookingRoomServices->links('pagination::bootstrap-4') }}
    </div>
</div>
