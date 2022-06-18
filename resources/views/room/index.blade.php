@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div id="room-list" class="container">
            @include('room.list')
        </div>
    </div>
    @foreach($floors as $k => $rooms)
        @foreach($rooms as $room)
            @include('room.modal-room')
        @endforeach
    @endforeach
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

            setInterval(function () {
                $.ajax({
                    type: "get",
                    url: "{{route('rooms.getMinutes')}}",
                    dataType: "json",
                    success: function (data) {
                        data.map(function (el, key) {
                            $('#room-' + el.room_id).find('#start_date .text').html(el.start_date);
                            $('#room-' + el.room_id).find('#minutes .text').html(el.minutes);
                            $('#room-' + el.room_id).find('#total_price .text').html(el.price);
                        });
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }, 1000);

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

                if (customerName == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '') {
                    $.toast({
                        text: 'Vui lòng nhập thông tin khách hàng',
                        icon: 'error',
                        position: 'top-right'
                    });
                    return false;
                }

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
                        refreshView();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            });

            $('body').on('click', '.btn-booking-room', function (e) {
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

                if (customerName == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '') {
                    $.toast({
                        text: 'Vui lòng nhập thông tin khách hàng',
                        icon: 'error',
                        position: 'top-right'
                    });
                    return false;
                }

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

                        // changeBgLi(_this, roomId);
                        refreshView();
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
                var customerName = modal.find('#customer_name').val();
                var customerIdCard = modal.find('#customer_id_card').val();
                var customerPhone = modal.find('#customer_phone').val();
                var customerAddress = modal.find('#customer_address').val();
                var startDate = modal.find('#start_date').val();
                var endDate = modal.find('#end_date').val();
                //
                // if (customerName == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '') {
                //     $.toast({
                //         text: 'Vui lòng nhập thông tin khách hàng',
                //         icon: 'error',
                //         position: 'top-right'
                //     });
                //     return false;
                // }

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

                        changeBgLi(_this, roomId);
                        refreshView();
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

                        changeBgLi(_this, roomId);
                        refreshView();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            });

            $('body').on('click', '.btn-change-status', function (e) {
                e.preventDefault();
                var _this = $(this);
                var modal = _this.closest('.modal');
                var roomId = modal.find('input[name="room_id"]').val();
                var href = _this.data('action');

                $.ajax({
                    type: "POST",
                    url: href,
                    data: {
                        room_id: roomId,
                    },
                    success: function (data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);

                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                        // changeBgLi(_this, roomId);
                        refreshView();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            });

            function changeBgLi(_this, roomId) {
                // var nextBg = _this.attr('data-bg');
                // var text = 'phòng trống';
                // $('li[data-bs-target="#booking-modal-' + roomId + '"]').removeClass('bg-' + nextBg);
                // if (nextBg == 'primary') {
                //     nextBg = 'warning';
                //     text = 'Đang có khách';
                // } else if (nextBg == 'warning') {
                //     nextBg = 'danger';
                //     text = 'Đang dọn phòng';
                // } else {
                //     nextBg = 'primary';
                //     text = 'phòng trống';
                // }
                // $('li[data-bs-target="#booking-modal-' + roomId + '"]').addClass('bg-' + nextBg);
                // $('li[data-bs-target="#booking-modal-' + roomId + '"]').find('.info-room a span').text(text);
            }
        });

        function refreshView()
        {
            $.ajax({
                type: "get",
                url: "{{route('rooms.index')}}",
                success: function (data) {
                    // $('.modal-backdrop').remove();
                    $('#room-list').html('').html(data);
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }
    </script>
    <style>
        @media (min-width: 1200px) {
            .modal-xl {
                max-width: 1300px;
            }
        }
    </style>
@endsection

