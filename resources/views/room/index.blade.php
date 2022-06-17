@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            @foreach($floors as $k => $rooms)
                <div class="row-room">
                    <h3>{{$k}}</h3>
                    <ul>
                        @foreach($rooms as $room)
                            <li class="booking-room" data-room-id="{{$room->id}}" data-bs-toggle="modal"
                                data-bs-target="#booking-modal-{{$room->id}}">
                                <h5 class="room-title">{{$room->name ?? ''}}</h5>
                                <div class="in-room">
                                    <div class="icon">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px"
                                                 y="0px"
                                                 viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000"
                                                 xml:space="preserve" id="svg-replaced-40"
                                                 class="image-svg replaced-svg svg-replaced-40">
                                                <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon
                                                </metadata>
                                                <g>
                                                    <path
                                                        d="M935.5,486.4V336.7c0-30.1-24.4-54.4-54.4-54.4H336.6c-30.1,0-54.4,24.4-54.4,54.4v149.7c-30.1,0-54.4,24.4-54.4,54.4v313c0,7.5,6.1,13.7,13.6,13.7H255c7.5,0,13.6-6.1,13.6-13.7v-67.9h680.5v67.9c0,7.5,6.1,13.7,13.7,13.7h13.6c7.5,0,13.7-6.1,13.7-13.7v-313C989.9,510.7,965.6,486.4,935.5,486.4z M323,350.3c0-15.1,12.2-27.2,27.2-27.2h517.2c15,0,27.2,12.2,27.2,27.2v136.1h-54.4v-81.6c0-15-12.2-27.2-27.2-27.2H663.3c-15.1,0-27.2,12.2-27.2,27.2v81.6h-54.4v-81.6c0-15-12.2-27.2-27.3-27.2H404.7c-15,0-27.2,12.2-27.2,27.2v81.6H323V350.3z M826.6,410.2v76.2H649.7v-76.2c0-10.5,8.8-19,19.7-19h137.6C817.8,391.1,826.6,399.6,826.6,410.2z M568,410.2v76.2H391.1v-76.2c0-10.5,8.8-19,19.7-19h137.6C559.2,391.1,568,399.6,568,410.2z M949.1,745H268.6v-40.8h680.5V745z M949.1,663.4H268.6v-109c0-15,12.2-27.2,27.2-27.2h626.1c15.1,0,27.2,12.2,27.2,27.2L949.1,663.4L949.1,663.4z M214.1,377.5c15,0,27.2-12.2,27.2-27.2l-27.2-190.6c0-15-12.2-27.2-27.3-27.2H64.4c-15,0-27.2,12.2-27.2,27.2L10,350.3c0,15,12.2,27.2,27.2,27.2h68v449.1H78c-7.5,0-13.7,6.1-13.7,13.7v13.5c0,7.5,6.1,13.7,13.7,13.7h95.2c7.5,0,13.6-6.1,13.6-13.7v-13.5c0-7.5-6.1-13.7-13.6-13.7h-27.2V377.5H214.1z M83.5,336.7c-10.5,0-19.1-8.8-19.1-19.7l19.1-124c0-10.8,8.5-19.7,19-19.7h46.2c10.5,0,19,8.8,19,19.7l19,124c0,10.8-8.5,19.7-19,19.7L83.5,336.7L83.5,336.7z"></path>
                                                </g> </svg>
                                        </a>
                                    </div>
                                    <div class="info-room">
                                        <a href="#"><span>{{$room->getStatusText()}}</span></a>
                                        @php
                                            $bookingRoom = $room->bookingRooms()->orderBy('id','DESC')->first();
                                        @endphp
                                        @if(!empty($bookingRoom))
                                            <p>
                                                <a href="#">
                                                    <strong class="time">{{$bookingRoom->getTimeStartDate()}}</strong>
                                                    <span class="time">{{$bookingRoom->getDateStartDate()}}</span>
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @include('room.modal-room')
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
          rel="stylesheet"/>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('.datetime-picker').datetimepicker({
                todayHighlight: true,
                format: 'Y-m-d H:i:s',
                startDate: new Date()
            });

            $('body').on('click', '.booking-room', function (e) {
                e.preventDefault();
                var roomTitle = $(this).find('.room-title').text();
                var floor = $(this).closest('.row-room').find('>h3').text();
                var roomId = $(this).attr('data-room-id');

                $('input[name="room_id"]').val(roomId);
                $('#booking-modal-' + roomId + ' .modal-title').text(roomTitle + ' - ' + floor);
            });

            $('body').on('click', '.btn-add-customer', function (e) {
                e.preventDefault();
                var _this = $(this);
                var modal = _this.closest('.modal');
                var roomId = modal.find('input[name="room_id"]').val();
                var customerName = modal.find('#customer_name').val();
                var customerIdCard = modal.find('#customer_id_card').val();
                var customerPhone = modal.find('#customer_phone').val();
                var customerAddress = modal.find('#customer_address').val();
                var startDate = modal.find('#start_date').val();
                var endDate = modal.find('#end_date').val();

                $.ajax({
                    type: "post",
                    url: "{{route('booking-room.store')}}",
                    data: {
                        room_id: roomId,
                        customer_name: customerName,
                        customer_id_card: customerIdCard,
                        customer_phone: customerPhone,
                        customer_address: customerAddress,
                        start_date: startDate,
                        end_date: endDate,
                    },
                    success: function (data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);
                            $.toast({
                                text: 'Cập nhật thành công',
                                icon: 'success',
                                position: 'top-right'
                            });
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            });

            $('body').on('click', '.btn-add-service', function (e) {
                e.preventDefault();
                var _this = $(this);
                var modal = _this.closest('.modal');
                var roomId = modal.find('input[name="room_id"]').val();
                var serviceId = _this.data('service_id');
                var startDate = modal.find('#start_date').val();
                var endDate = modal.find('#end_date').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('booking-room.store')}}",
                    data: {
                        room_id: roomId,
                        service_id: serviceId,
                        start_date: startDate,
                        end_date: endDate,
                    },
                    success: function (data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            });

            $('body').on('click', '.btn-remove-service', function (e) {
                e.preventDefault();
                var _this = $(this);
                var modal = _this.closest('.modal');
                var bookingRoomServiceId = _this.data('booking_room_service_id');
                var roomId = modal.find('input[name="room_id"]').val();
                var href = _this.attr('href');

                $.ajax({
                    type: "POST",
                    url: href,
                    data: {
                        "_method": 'DELETE',
                        room_id: roomId,
                        booking_room_service_id: bookingRoomServiceId,
                    },
                    success: function (data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            });
        });
    </script>
@endsection
