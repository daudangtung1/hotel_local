<table class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên phòng</th>
            <th scope="col">Tầng</th>
            <th scope="col">Giá theo giờ</th>
            <th scope="col">Giá theo ngày</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($floors))
        @forelse($floors as $key => $rooms)
        @foreach($rooms as $room)
        <?php
        $checked = '';
        $bgColor = '';
        if (!empty($roomIds)) {
            if (in_array($room->id, $roomIds)) {
                $checked = 'checked';
                $bgColor = '#ffb3b3';
            }
        }
        ?>
        <tr style="background-color: {{$bgColor}}">
            <td><input type="checkbox" {{$checked}} name="room_ids[]" value="{{$room->id ??''}}"></td>
            <td>{{$room->name ??'Đã xóa'}}</td>
            <td>{{$room->floor ??'Đã xóa'}}</td>
            <td>{{get_price($room->hour_price ?? 0, 'đ')}}</td>
            <td>{{get_price($room->day_price ?? 0, 'đ')}}</td>
        </tr>
        @endforeach
        @empty
        <tr>
            <td colspan="5">Không có dữ liệu</td>
        </tr>
        @endforelse
        @endif
    </tbody>
</table>