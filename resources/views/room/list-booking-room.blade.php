<table class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('Room_name')}}</th>
            <th scope="col">{{__('Level')}}</th>
            <th scope="col">{{__('Hourly_price')}}</th>
            <th scope="col">{{__('Daily_price')}}</th>
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
            <td>{{$room->name ?? __('Deleted')}}</td>
            <td>{{$room->floor ?? __('Deleted')}}</td>
            <td>{{get_price($room->hour_price ?? 0, 'đ')}}</td>
            <td>{{get_price($room->day_price ?? 0, 'đ')}}</td>
        </tr>
        @endforeach
        @empty
        <tr>
            <td colspan="5">{{__('No_data')}}</td>
        </tr>
        @endforelse
        @endif
    </tbody>
</table>