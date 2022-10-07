<div class="col-md-12">
    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="filter">
            <form action="{{route('reports.index')}}" class="d-flex" method="GET">
                <input type="text" autocomplete="off"  class="form-control form-control-sm me-2 filter-date-not-time" placeholder="Chọn ngày" name="start_date" value="@if(!empty(request()->start_date)) {{request()->start_date}} @endif"  autocomplete="off">
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
            <th scope="col">Phòng</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Tổng</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($items))
            @foreach ($items as $key => $item)
            <tr>
                <td>{{ \App\Models\Room::ARRAY_ROOM[$key] }}</td>
                <td>
                    @if (in_array($key, [\App\Models\Room::IN, \App\Models\Room::OUT]))
                        <span>
                            @foreach ($rooms as $room)
                                @if (in_array($room->id, $item['list']->pluck('id')->toArray()))
                                    <b>{{ $room->name }}</b>
                                @else
                                    {{ $room->name }}
                                @endif
                            @endforeach
                        </span>
                    @elseif ($key == \App\Models\Room::NOT_FOR_RENT_TEXT)
                        @foreach($item['list'] as $key => $data)
                            <p>{{ implode($data, ',') . ": " . $key}}</p>
                        @endforeach
                    @else
                        <span>
                            @foreach($item['list'] as $data)
                                {{ $data->name }}
                            @endforeach
                        </span>
                    @endif
                </td>
                <td>{{ $item['total'] }}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">Không có dữ liệu</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
