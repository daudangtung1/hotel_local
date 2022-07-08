<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel='stylesheet' href='https://anovavn.com/wpdemo/Hotel/wp-includes/css/dist/block-library/style.min.css'
          type='text/css'
          media='all'/>
    <link rel='stylesheet'
          href='https://fonts.googleapis.com/css2?family=Montserrat%3Awght%40100%3B200%3B300%3B400%3B500%3B600%3B700%3B800&#038;display=swap&#038;ver=6.0'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='font-awesome-css'
          href='{{asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='nice-select-css-css' href='{{asset('vendors/nice-select/nice-select.css')}}'
          type='text/css'
          media='all'/>
    <link rel='stylesheet' id='datetimepicker-min-css-css'
          href='{{asset('vendors/datetimepicker/jquery.datetimepicker.min.css')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='animatecss-css' href='{{asset('assets/css/animate.css')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='maincss-css' href='{{asset('assets/css/main.css')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='custom-css-css' href='{{asset('assets/css/custom.css')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='dv-theme-style-css' href='{{asset('assets/css/style.css')}}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='jquery-ui-css' href='https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css'
          type='text/css' media='all'/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/css/bootstrap-datetimepicker.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <style>
        .div-scroll{
            max-height: 500px;
            overflow-y: scroll;
        }
        .max-height-300{
            max-height: 300px;
        }
        /* ADD by Quan */
        .boder-validate {
            border: 1px solid #dc3545 !important;

        }
        .boder-validate:focus {
            outline: rgba(255, 7, 7, 0.4) solid 4px !important;
        }
        /* end Add */
    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body>

<div class="wrapper">

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    @include('layouts.message')

</div>
<script src='{{asset('vendors/fancybox/jquery.fancybox.min.js')}}'></script>
<script src='{{asset('vendors/nice-select/jquery.nice-select.js')}}'></script>
<script src='{{asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js')}}'></script>
<script src='{{asset('js/main.js')}}' id='mainjs-js'></script>
<script src='{{asset('vendors/slick/slick.min.js')}}' id='slick-js-js'></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src='https://npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js'
        id='isotope-js-js'></script>
<script src='{{asset('assets/js/main.js')}}' id='mainjs-js'></script>

<script src='{{asset('assets/js/custom.js')}}' id='custom-js-js'></script>
<script src='https://anovavn.com/wpdemo/Hotel/wp-includes/js/jquery/ui/core.min.js?ver=1.13.1'></script>
<script src='https://anovavn.com/wpdemo/Hotel/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.13.1'></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
      rel="stylesheet"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script id='jquery-ui-datepicker-js-after'>
    jQuery(function (jQuery) {
        jQuery.datepicker.setDefaults({
            "closeText": "Close",
            "currentText": "Today",
            "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "monthNamesShort": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            "nextText": "Next",
            "prevText": "Previous",
            "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
            "dateFormat": "MM d, yy",
            "firstDay": 1,
            "isRTL": false
        });
    });
</script>
<style>
    li.bg-success svg,
    li.bg-success *,
    li.bg-secondary svg,
    li.bg-secondary *,
    li.bg-danger svg,
    li.bg-danger *,
    li.bg-primary svg,
    li.bg-primary * {
        color: #fff !important;
        fill: #fff !important;
    }
</style>
@yield('script')
<div class="modal fade" id="option-contact" tabindex="-1" 
     aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>
<div class="modal fade" id="booking-room"
     aria-labelledby="booking-modalLabel" aria-hidden="true">
    @include('room.model-booking-room')
</div>

<script>
    $(document).ready(function () {
        $('body').on('click', '.btn-booking-multiple-room', function () {
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
            $('input[name="room_ids[]"]:checked').map(function () {
                roomIds.push($(this).val());
            });
            if (roomIds == '') {
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
                $('input[name="end_date"]').map(function () {
                    $(this).addClass('boder-validate');
                });
                return false;
            }else if(startDate < endDate) {
                $('input[name="end_date"]').map(function () {
                    $(this).removeClass('boder-validate');
                });
            }

            if (customerName == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '' || startDate == '' || endDate == '') {
                $.toast({
                    text: 'Vui lòng nhập thông tin khách hàng',
                    icon: 'error',
                    position: 'top-right'
                });

                $("#form-booking-multiple input[type=text]").each(function () {
                    if ($(this).hasClass('validate')) {
                        if ($(this).val() == '') {
                            $(this).addClass('boder-validate');
                        } else if ($(this).hasClass('boder-validate')) {
                            $(this).removeClass('boder-validate');
                        }
                    }
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
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        var date = $('.datetime-picker');
        if (date) {
            date.datetimepicker({
                todayHighlight: true,
                format: 'Y-m-d H:i',
                startDate: new Date()
            });
        }


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
                $("#form-booking input[type=text]").each(function () {
                    if ($(this).hasClass('validate')) {
                        if ($(this).val() == '') {
                            $(this).addClass('boder-validate');
                        } else if ($(this).hasClass('boder-validate')) {
                            $(this).removeClass('boder-validate');
                        }
                    }
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

        $('body').on('keyup', 'input[name="quantity_service"]', function (e) {
            var _this = $(this);
            var modal = _this.closest('.modal');
            var quantityService = _this.val();
            var href = _this.data('url_update');
            var roomId = modal.find('input[name="room_id"]').val();
            $.ajax({
                type: "POST",
                url: href,
                data: {
                    "_method": 'PUT',
                    quantity: quantityService,
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
                    _this.closest('.modal').find('.modal-dialog').html(data);

                    changeBgLi(_this, roomId);
                    refreshView();
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


        $('body').on('click', '.btn-ajax-delete-customer', function (e) {
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
                    if (data.status == 0) {
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
            var bookingRoomStatus = modal.find('#booking_room_status').val();

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
                    booking_room_status: bookingRoomStatus,
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


        function changeBgLi(_this, roomId) {

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

    $('body').on('click', '.contact', function() {
        // $('#option-contact').modal('show');
        $.ajax({
            type: "get",
            url: "{{route('options.index')}}",
            success: function (data) {
             $('#option-contact').html('').html(data);
             $('#option-contact').modal('show');
            },
            error: function(e) {
                console.log(e)
            }
        })
    })
</script>
<style>
    @media (min-width: 1200px) {
        .modal-xl {
            max-width: 1300px;
        }
    }

    td a svg {
        width: 15px;
        height: 15px;
    }
    ul,ol{
        padding-left: 0;
    }
    
    .form-filter {
        padding: 22px 0px;
    }
</style>

</body>
</html>
