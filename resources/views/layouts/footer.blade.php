<footer id="colophon" class="site-footer mt-5" role="contentinfo">
    <div class="container">
        <ul class="list-item">
            <li>
                <p>Sẵn sàng: {{\App\Models\Room::where('status', \App\Models\Room::READY)->count()}}</p>
            </li>
            <li>
                <p>Có khách: {{\App\Models\Room::where('status', \App\Models\Room::HAVE_GUEST)->count()}}</p>
            </li>
            <li>
                <p>Khách ra ngoài: {{\App\Models\Room::where('status', \App\Models\Room::GUEST_OUTDOOR)->count()}}</p>
            </li>
            <li>
                <p>Bẩn: {{\App\Models\Room::where('status', \App\Models\Room::DIRTY)->count()}}</p>
            </li>
            <li>
                <p>Đang dọn: {{\App\Models\Room::where('status', \App\Models\Room::CLEAN_ROOM)->count()}}</p>
            </li>
            <li>
                <p>Đang sửa: {{\App\Models\Room::where('status', \App\Models\Room::FIXING_ROOM)->count()}}</p>
            </li>
            <li>
                <p>
                    <span class="d-inline-block" style="margin-right: 5px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                        <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"></path>
                        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"></path>
                    </svg>
                    </span>
                    <a href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#booking-room">Đặt phòng:{{\App\Models\BookingRoom::where('status', \App\Models\Room::BOOKED)->count()}}</a></p>
            </li>
        </ul>
    </div>
</footer><!-- #colophon -->

<div class="modal fade" id="booking-room"
     aria-labelledby="booking-modalLabel" aria-hidden="true">
    @include('room.model-booking-room')
</div>

<script>
    $(document).ready(function(){
        $('body').on('click', '.btn-booking-multiple-room', function(){
            var _this = $(this);
            var modal = _this.closest('.modal');
            var customerName = modal.find('#customer_name').val();
            var customerIdCard = modal.find('#customer_id_card').val();
            var customerPhone = modal.find('#customer_phone').val();
            var customerAddress = modal.find('#customer_address').val();
            var startDate = modal.find('#start_date').val();
            var endDate = modal.find('#end_date').val();
            var note = modal.find('.note').val();

            var roomIds = [];
            $('input[name="room_ids[]"]:checked').map(function() {
                roomIds.push($(this).val());
            });
            if(roomIds == '') {
                $.toast({
                    text: 'Vui lòng chọn phòng cần đặt.',
                    icon: 'error',
                    position: 'top-right'
                });
                return false;
            }
            if (startDate >= endDate) {
                $.toast({
                    text: 'Vui lòng nhập kết thúc lớn hơn ngày bắt đầu',
                    icon: 'error',
                    position: 'top-right'
                });
                return false;
            }

            if (customerName == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '' || startDate == '' || endDate == '' ) {
                $.toast({
                    text: 'Vui lòng nhập thông tin khách hàng',
                    icon: 'error',
                    position: 'top-right'
                });
                return false;
            }

            $.ajax({
                type: "post",
                url: "{{route('booking-room.booking_rooms')}}",
                data: {
                    room_ids: roomIds,
                    customer_name: customerName,
                    customer_id_card: customerIdCard,
                    customer_phone: customerPhone,
                    customer_address: customerAddress,
                    start_date: startDate,
                    end_date: endDate,
                    note: note,
                },
                success: function (data) {
                    if (typeof data.response !== 'undefined') {
                        $.toast({
                            text: data.response.message,
                            icon: 'error',
                            position: 'top-right'
                        });
                        return false;
                    }
                    modal.find('.modal-dialog').html(data);
                    $.toast({
                        text: 'Cập nhật thành công',
                        icon: 'success',
                        position: 'top-right'
                    });
                    // refreshView();
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }) ;
    });
</script>
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
        var date = $('.datetime-picker');
        date.datetimepicker({
            todayHighlight: true,
            format: 'Y-m-d H:i',
            startDate: new Date()
        });

        $('body').on('change', '.rentType', function (e) {
            e.preventDefault();
            var _this = $(this);
            var modal = _this.closest('.modal');
            var rentType = _this.val();

            if (rentType == 1) {
                var now = '{{\Carbon\Carbon::createFromFormat('Y-m-d H:i', \Carbon\Carbon::now()->format('Y-m-d') . ' 12:00')}}';
                modal.find('#start_date').val(now);
                modal.find('#end_date').val(now);
                modal.find('#box-end-date').removeClass('d-none');
                modal.find('.extra-price-box').removeClass('d-none');
            } else {
                var now = '{{\Carbon\Carbon::createFromFormat('Y-m-d H:i', \Carbon\Carbon::now()->format('Y-m-d H:i'))}}';
                modal.find('#start_date').val(now);
                modal.find('#end_date').val(now);
                modal.find('#box-end-date').addClass('d-none');
                modal.find('.extra-price-box').addClass('d-none');
            }
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
        }, 2000);

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
            var note = modal.find('.note').val();
            var price = modal.find('.price').val();
            var rentType = modal.find('input[name="rent_type"]:checked').val();
            var extraPrice = modal.find('input[name="extra_price"]').val();

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
                    note: note,
                    price: price,
                    rent_type: rentType,
                    extra_price: extraPrice,
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
                    if( data.status == 0 ){
                        $.toast({
                            text: data.massage,
                            icon: 'warning',
                            position: 'top-right'
                        });
                        return false;
                    }
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


        $('body').on('click', '.btn-update', function (e) {
            e.preventDefault();

            var _this = $(this);
            var modal = _this.closest('.modal');
            var bookingRoomId = _this.data('booking_room_id');
            var note = modal.find('.note').val();
            var roomId = modal.find('input[name="room_id"]').val();
            var price = modal.find('.price').val();
            var rentType = modal.find('input[name="rent_type"]:checked').val();
            var extraPrice = modal.find('input[name="extra_price"]').val();
            console.log(rentType);

            $.ajax({
                type: "POST",
                url: "{{route('booking-room.update_booking_room')}}",
                data: {
                    booking_room_id: bookingRoomId,
                    note: note,
                    price: price,
                    room_id: roomId,
                    rent_type: rentType,
                    extra_price: extraPrice,
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

        {{--$('body').on('change', '.note', function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    var _this = $(this);--}}
        {{--    var modal = _this.closest('.modal');--}}
        {{--    var roomId = modal.find('input[name="room_id"]').val();--}}
        {{--    var bookingRoomId = modal.find('input[name="booking_room_id"]').val();--}}
        {{--    var val = _this.val();--}}

        {{--    $.ajax({--}}
        {{--        type: "POST",--}}
        {{--        url: '{{route('booking-room.update_note')}}',--}}
        {{--        data: {--}}
        {{--            note: val,--}}
        {{--            booking_room_id: bookingRoomId,--}}
        {{--            room_id: roomId,--}}
        {{--        },--}}
        {{--        success: function (data) {--}}
        {{--            // _this.closest('.modal').find('.modal-dialog').html(data);--}}
        {{--            $.toast({--}}
        {{--                text: 'Cập nhật thành công',--}}
        {{--                icon: 'success',--}}
        {{--                position: 'top-right'--}}
        {{--            });--}}

        {{--            refreshView();--}}
        {{--        },--}}
        {{--        error: function (e) {--}}
        {{--            console.log(e);--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}

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

    function refreshView() {
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
    td a svg{
        width: 15px;
        height: 15px;
    }
</style>
