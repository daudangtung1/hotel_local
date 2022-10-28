<table class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên công nợ</th>
            <th scope="col">Đặt phòng</th>
            <th scope="col">Số tiền nợ</th>
            <th scope="col">Tình trạng</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($items))
        @forelse($items as $key => $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{!!$item->name ?? '-'!!}</td>
            <td>
                <p><b>Phòng</b> {!! $item->bookingRoom->room->name ?? '' !!}</p>
                <p><b>Tầng:</b> {{$item->bookingRoom->room->floor ?? ''}}</p>
                <p><b>Ngày vào: </b>{{$item->bookingRoom->start_date ?? ''}}</p>
                <p><b>Ngày ra: </b>{{$item->bookingRoom->end_date ?? ''}}</p>
            </td>
            <td>{{get_price($item->price ?? 0, 'đ')}}</td>
            <td>{{\App\Models\Debt::ARRAY_STATUS[$item->status]}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">Không có dữ liệu</td>
        </tr>
        @endforelse
        @else
        <tr>
            <td colspan="5">Không có dữ liệu</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-center mt-2 mb-2">
    {{ $items->links('pagination::bootstrap-4') }}
</div>