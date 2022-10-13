@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div id="room-list" class="container">
            @include('room.list')
        </div>
    </div>
    @foreach($floors as $k => $rooms)
        @foreach($rooms as $room)
            @include('room.modal-room', ['room' => $room])
        @endforeach
    @endforeach
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('body').on('click', '.filter_room', function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{route('rooms.index')}}",
                data: {
                    type_room: $('#select-type-room').val(),
                    area: $('#select-area').val(),
                    order_by: $('#select-order').val()
                },
                success: function (data) {
                  $('#room-list').html('').html(data)
                },
                error: function (e) {
                    console.log(e);
                }
            })
        });
        });
</script>
@endsection

