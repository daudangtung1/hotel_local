@can('Quản lý đặt phòng-create')
@foreach($floors as $k => $rooms)
<div class="row-room">
    <h3>{{$k}}</h3>
    <ul style="padding-left: 0px">
        @foreach($rooms as $room)
        <li class="@if($room->status != \App\Models\Room::NOT_FOR_RENT) booking-room @endif bg-{{$room->getBgButton()}}  position-relative" data-room_id="{{$room->id}}" data-room_url="{{route('rooms.show', ['room' => $room])}}"> 
            <div @if($room->status != \App\Models\Room::NOT_FOR_RENT)data-room_id="{{$room->id}}" @endif  id="room-{{$room->id}}" class="show-room-popup" data-room_id="{{$room->id}}" data-room_url="{{route('rooms.show', ['room' => $room])}}">
                <h5 class="room-title">{{$room->name ?? ''}}</h5>
                <div class="in-room align-items-start">
                    <div class="icon">
                        @if($room->bookingRooms()->where('status', \App\Models\Room::BOOKED)->count() > 0)
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                            <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z" />
                            <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z" />
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve" id="svg-replaced-40" class="image-svg replaced-svg svg-replaced-40">
                            <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon
                            </metadata>
                            <g>
                                <path d="M935.5,486.4V336.7c0-30.1-24.4-54.4-54.4-54.4H336.6c-30.1,0-54.4,24.4-54.4,54.4v149.7c-30.1,0-54.4,24.4-54.4,54.4v313c0,7.5,6.1,13.7,13.6,13.7H255c7.5,0,13.6-6.1,13.6-13.7v-67.9h680.5v67.9c0,7.5,6.1,13.7,13.7,13.7h13.6c7.5,0,13.7-6.1,13.7-13.7v-313C989.9,510.7,965.6,486.4,935.5,486.4z M323,350.3c0-15.1,12.2-27.2,27.2-27.2h517.2c15,0,27.2,12.2,27.2,27.2v136.1h-54.4v-81.6c0-15-12.2-27.2-27.2-27.2H663.3c-15.1,0-27.2,12.2-27.2,27.2v81.6h-54.4v-81.6c0-15-12.2-27.2-27.3-27.2H404.7c-15,0-27.2,12.2-27.2,27.2v81.6H323V350.3z M826.6,410.2v76.2H649.7v-76.2c0-10.5,8.8-19,19.7-19h137.6C817.8,391.1,826.6,399.6,826.6,410.2z M568,410.2v76.2H391.1v-76.2c0-10.5,8.8-19,19.7-19h137.6C559.2,391.1,568,399.6,568,410.2z M949.1,745H268.6v-40.8h680.5V745z M949.1,663.4H268.6v-109c0-15,12.2-27.2,27.2-27.2h626.1c15.1,0,27.2,12.2,27.2,27.2L949.1,663.4L949.1,663.4z M214.1,377.5c15,0,27.2-12.2,27.2-27.2l-27.2-190.6c0-15-12.2-27.2-27.3-27.2H64.4c-15,0-27.2,12.2-27.2,27.2L10,350.3c0,15,12.2,27.2,27.2,27.2h68v449.1H78c-7.5,0-13.7,6.1-13.7,13.7v13.5c0,7.5,6.1,13.7,13.7,13.7h95.2c7.5,0,13.6-6.1,13.6-13.7v-13.5c0-7.5-6.1-13.7-13.6-13.7h-27.2V377.5H214.1z M83.5,336.7c-10.5,0-19.1-8.8-19.1-19.7l19.1-124c0-10.8,8.5-19.7,19-19.7h46.2c10.5,0,19,8.8,19,19.7l19,124c0,10.8-8.5,19.7-19,19.7L83.5,336.7L83.5,336.7z"></path>
                            </g>
                        </svg>
                        @endif
                    </div>
                    <div class="info-room">
                        @php
                        $bookingRoom = $room->bookingRooms()->orderBy('id','DESC')->first();
                        $bookingRoomFirstOrder = $room->bookingRooms()->whereNull('checkout_date')->orderBy('start_date','ASC')->first();
                        @endphp
                        <span>{{$room->getStatusText()}}</span>
                        @if($room->status == \App\Models\Room::NOT_FOR_RENT)
                        <p>Lý do: {{$room->status_desc ?? ''}}</p>
                        @endif
                        @if(!empty($bookingRoom) && $room->status == \App\Models\Room::DIRTY)
                        <span>Tổng tiền: <b>{{$bookingRoom->getTotalPrice()}}</b></span>
                        @endif
                        @if(!empty($bookingRoom))
                        @if($room->status == \App\Models\Room::HAVE_GUEST)
                        <p>
                            <span id="start_date" class="d-block time small"><small>{{__('Time_enter')}}: <span class="text">{{$bookingRoom->getTimeStartDate()}} {{$bookingRoom->getDateStartDate()}}</span></small></span>
                            <span id="minutes" class="d-block time small"><small>{{__('Time_2')}}: <span class="text">{{$bookingRoom->getTime(true)}}</span></small></span>
                            <span id="total_price" class="d-block time small"><small>{{__('Total')}}: <span class="text">{{$bookingRoom->getTotalPrice()}}</span> </small></span>
                        </p>
                        @else
                        <p>
                            <strong class="time">{{$bookingRoom->getTimeCheckoutDate()}}</strong>
                            <span class="time">{{$bookingRoom->getDateCheckoutDate()}}</span>
                        </p>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @if($bookingRoomFirstOrder)
            <div class="room" data-room-id="{{$room->id}}" style="position:absolute; right: 10px;top: 10px;">
                <button style="background-color: #cd4c00;color: #fff;" id="btn-infor-booking-room" class="btn btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                        <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"></path>
                        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"></path>
                    </svg>
                </button>
            </div>
            @endif
            @if($bookingRoomFirstOrder)
            <span class="d-block time small">
                <small>{{__('Booking_room')}}:
                    <span class="text">{{$bookingRoomFirstOrder->getTimeStartDate()}} {{$bookingRoomFirstOrder->getDateStartDate()}}</span>
                </small>
            </span>
            @endif
        </li>

        @endforeach
    </ul>
</div>
@endforeach
@section('script')
<script>
    $(document).ready(function() {
        $('body').on('click', '#btn-infor-booking-room', function() {
            var room_id = $(this).closest('.room').data('room-id');
            setTimeout(() => {
                $('#booking-modal-' + room_id).modal('hide')
            }, 500);
            $.ajax({
                type: 'GET',
                url: "{{route('booking-room.booking_room_info')}}",
                data: {
                    room_id: room_id
                },
                success: function(data) {
                    $('#booking-info').html('').html(data);
                    $('#booking-info').modal('show');
                },
                error: function(e) {
                    console.log(e)
                }
            })
        })
    })
</script>
@endsection
@endcan