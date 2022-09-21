<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }}</title>
    <style>
        .site-footer{
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ffff;
            z-index: 9;
            padding-top: 25px;
        }
        .list-ajax,
        #list-item-customer{
            max-height: 300px;
            overflow: auto;
            position: absolute;
    left: 0;
    right: 0;
    top: 100%;
    z-index: 9;
    }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 1);
            z-index: 9999;
        }

        #loader {
            display: block;
            position: relative;
            left: 50%;
            top: 50%;
            width: 80px;
            height: 80px;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #9370DB;
            -webkit-animation: spin 0.6s linear infinite;
            animation: spin 0.6s linear infinite;
        }

        #loader:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #BA55D3;
            -webkit-animation: spin 3s linear infinite;
            animation: spin 3s linear infinite;
        }

        #loader:after {
            content: "";
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #FF00FF;
            -webkit-animation: spin 1.5s linear infinite;
            animation: spin 1.5s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

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
        .div-scroll {
            max-height: 500px;
            overflow-y: scroll;
        }

        .max-height-300 {
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
<div id="preloader">
    <div id="loader"></div>
</div>
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


@yield('script')
<div class="modal fade" id="option-contact" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>
<div class="modal fade" id="booking-info" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>
<div class="modal fade" id="group-customer-booking" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>
<div class="modal fade" id="booking-room"
     aria-labelledby="booking-modalLabel" aria-hidden="true">
    @include('room.model-booking-room', ['bookingRoom' => null])
</div>

<script>
    $(window).on('load', function () {
        $('#preloader').fadeOut('fast');
    });
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
            var extra_price = modal.find('#extra_price').val();

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
            } else if (startDate < endDate) {
                $('input[name="end_date"]').map(function () {
                    $(this).removeClass('boder-validate');
                });
            }

            if (customerName == '' || extra_price == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '' || startDate == '' || endDate == '') {
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
                    extra_price: extra_price
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
                    resetFormBooking();
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

        function resetFormBooking() {
            var now = '{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', \Carbon\Carbon::now()->format('Y-m-d H:i:s'))}}';
            $('#booking-room').find('#customer_name').val('');
            $('#booking-room').find('#customer_phone').val('');
            $('#booking-room').find('#customer_id_card').val('');
            $('#booking-room').find('#customer_address').val('');
            $('#booking-room').find('.note').val('');
            $('#booking-room').find('#start_date').val(now);
            $('#booking-room').find('#end_date').val(now);

            setTimeout(function () {
                $('#booking-room').find('#end_date').trigger('change');
            }, 300);
        }
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
        var dateNotTime = $('.filter-date-not-time');
        if (dateNotTime) {
            dateNotTime.datetimepicker({
                todayHighlight: true,
                format: 'Y-m-d',
                startDate: new Date(),
                timepicker: false,
            });
        }


        $('body').on('change', '.rentType', function (e) {
            e.preventDefault();
            var _this = $(this);
            var modal = _this.closest('.modal');
            var rentType = _this.val();

            if (rentType == 1 || rentType == 2) {
                var now = '{{\Carbon\Carbon::createFromFormat('Y-m-d H:i', \Carbon\Carbon::now()->format('Y-m-d') . ' 12:00')}}';
                var next = '{{\Carbon\Carbon::createFromFormat('Y-m-d H:i', \Carbon\Carbon::now()->addDay(1)->format('Y-m-d') . ' 12:00')}}';
                modal.find('#start_date').val(now);
                modal.find('#end_date').val(next);
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

        var debounce = null;
        $('body').on('keyup', '#customer_name', function(e) {
            clearTimeout(debounce);
            var customer_name = $(this).val();
            var modal = $(this).closest('.modal');
            var room_id = modal.find('input[name="room_id"]').val();
            debounce = setTimeout(function() {
                $.ajax({
                type: 'GET',
                url: "{{route('customers.search')}}",
                data: {
                    name: customer_name
                },
                success: function (data) {
                    modal.find('#list-item-customer').html('').html(data)
                },
                error: function (e) {
                    console.log(e)
                }
            })
            }, 500);
        });

        $('body').on('keyup', '#customer_name', function(e) {
            clearTimeout(debounce);
            var customer_name = $(this).val();
            var modal = $(this).closest('.modal');
            var room_id = modal.find('input[name="room_id"]').val();
            debounce = setTimeout(function() {
                $.ajax({
                type: 'GET',
                url: "{{route('customers.search')}}",
                data: {
                    name: customer_name,
                    type:'name'
                },
                success: function (data) {
                    modal.find('#list-item-customer').html('').html(data)
                },
                error: function (e) {
                    console.log(e)
                }
            })
            }, 500);
        });

        $('body').on('keyup', '#customer_id_card', function(e) {
            clearTimeout(debounce);
            var customer_name = $(this).val();
            var modal = $(this).closest('.modal');
            var room_id = modal.find('input[name="room_id"]').val();
            debounce = setTimeout(function() {
                $.ajax({
                type: 'GET',
                url: "{{route('customers.search')}}",
                data: {
                    name: customer_name,
                    type:'id_card'
                },
                success: function (data) {
                    modal.find('#list-item-id_card').html('').html(data)
                },
                error: function (e) {
                    console.log(e)
                }
            })
            }, 500);
        });

        $('body').on('keyup', '#customer_phone', function(e) {
            clearTimeout(debounce);
            var customer_name = $(this).val();
            var modal = $(this).closest('.modal');
            var room_id = modal.find('input[name="room_id"]').val();
            debounce = setTimeout(function() {
                $.ajax({
                type: 'GET',
                url: "{{route('customers.search')}}",
                data: {
                    name: customer_name,
                    type:'phone'
                },
                success: function (data) {
                    modal.find('#list-item-phone').html('').html(data)
                },
                error: function (e) {
                    console.log(e)
                }
            })
            }, 500);
        });


        $('body').on('click', '#list-group-customer a', function(e) {
            var modal = $(this).closest('.modal');
            var room_id = $(this).closest('.modal').find('input[name="room_id"]').val();
            var customer_id =  $(this).data('id');
            $.ajax({
                type: 'GET',
                url: "customers/" + customer_id,
                dataType: "json",
                success: function (data) {
                    var customer = data.customer;
                    modal.find('#customer_name').val(customer.name);
                    modal.find('#customer_address').val(customer.address);
                    modal.find('#customer_phone').val(customer.phone);
                    modal.find('#customer_id_card').val(customer.id_card);
                    modal.find('#list-group-customer').remove();
                },
                error: function (e) {
                    console.log(e)
                }
            })
        })

        function validateRoom()
        {
            var endDate = $('#end_date').val();
            var startDate = $('#start_date').val();
            $.ajax({
                type: "GET",
                url: "{{route('booking-room.index')}}",
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function (data) {
                    $('#list-booking-room').html('').html(data);
                    $('#preloader').fadeOut();
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }

        $('body').on('change', '#end_date, #start_date', function(e) {
            e.preventDefault();
            $('#preloader').css('background-color', 'rgba(255,255,255,0.8)').show();
            validateRoom();
        })

        $('body').on('click', '.btn-checkin', function(e) {
            e.preventDefault();
            var bookingRoomId = $(this).attr('data-booking_room_id');
            var modal = $(this).closest('.modal');
            $.ajax({
                type: "GET",
                url: "{{route('booking-room.booking')}}",
                data: {
                    booking_room_id: bookingRoomId,
                },
                success: function (data) {
                    console.log(data);
                    if (data.status == false && data.message) {
                        $.toast({
                            text: data.message,
                            icon: 'error',
                            position: 'top-right'
                        });
                        return false;
                    } else {
                        $('#room-list').html('').html(data);
                        modal.modal('hide');
                    }

                },
                error: function (e) {
                    console.log(e);
                }
            })

        })

        $('body').on('shown.bs.modal', '#booking-room', function(e) {
            setTimeout(function () {
                $('#booking-room').find('#end_date').trigger('change');
            }, 500)
            var now = '{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', \Carbon\Carbon::now()->format('Y-m-d H:i:s'))}}';
            $(this).find('#customer_name').val('');
            $(this).find('#customer_phone').val('');
            $(this).find('#customer_id_card').val('');
            $(this).find('#customer_address').val('');
            $(this).find('.note').val('');
            $(this).find('#start_date').val(now);
            $(this).find('#end_date').val(now);
        })

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
        }, 600000);

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
                    if (typeof data.response !== 'undefined') {
                        $.toast({
                            text: data.response.message,
                            icon: 'error',
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

        $('body').on('click', '.modal table input[name="select"]', function (e) {
            e.preventDefault();
            var _this = $(this);
            var modal = _this.closest('.modal');
            var roomId = modal.find('input[name="room_id"]').val();
            var serviceId = _this.val();
            console.log(serviceId);

        });

        var debounce = null;
        $('body').on('keyup', 'input[name="quantity_service"]', function (e) {
            var _this = $(this);
            var modal = _this.closest('.modal');
            var quantityService = _this.val().replace(/^\s+|\s+$/g, "");
            var href = _this.data('url_update');
            var roomId = modal.find('input[name="room_id"]').val();

            if (quantityService == '0') {
                $(this).val(1);
                quantityService = 1;
            }

            clearTimeout(debounce);
            debounce = setTimeout(function(){
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
            }, 1000);
        });

        $('body').on('click', '.modal tr .model-btn-add-service', function (e) {
            e.preventDefault();

            var _this = $(this);
            var modal = _this.closest('.modal');
            var td = _this.closest('td');

            var roomId = modal.find('input[name="room_id"]').val();
            var modalStartDate = td.find('.modal_start_date').val();
            var modalEndDate = td.find('.modal_end_date').val();
            var modalServiceId = td.find('.modal_service_id').val();

            if(modalStartDate == '' || modalEndDate == '') {
                _this.closest('tr').find('td .row').removeClass('d-none');
                $.toast({
                    text: 'Vui lòng nhập ngày bắt đầu và kết thúc',
                    icon: 'warning',
                    position: 'top-right'
                });
                return false;

            }

            if(modalEndDate <= modalStartDate ) {
                $.toast({
                    text: 'Ngày bắt đầu phải bé thua ngày kết thúc',
                    icon: 'warning',
                    position: 'top-right'
                });
                return false;
            }

            $.ajax({
                type: "POST",
                url: "{{route('booking-room.store')}}",
                data: {
                    room_id: roomId,
                    service_id: modalServiceId,
                    modal_end_date: modalEndDate,
                    modal_start_date: modalStartDate,
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

        $('body').on('click', '.btn-add-service', function (e) {
            e.preventDefault();

            var _this = $(this);
            var modal = _this.closest('.modal');
            var saleType = _this.attr('data-sale_type');


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
            var modalStartDate = modal.find('.modal_start_date').val();
            var modalEndDate = modal.find('.modal_end_date').val();

            _this.closest('tbody').find('td .row').addClass('d-none');
            _this.closest('tbody').find('.modal_end_date').val('');
            _this.closest('tbody').find('.modal_start_date').val('');


            if(saleType == 0 && (modalStartDate == '' || modalEndDate == '')) {
                _this.closest('tr').find('td .row').removeClass('d-none');
                return false;
            }

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
                    console.log(data);
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

    $('body').on('click', '.contact', function () {
        $.ajax({
            type: "get",
            url: "{{route('options.index')}}",
            success: function (data) {
                $('#option-contact').html('').html(data);
                $('#option-contact').modal('show');
            },
            error: function (e) {
                console.log(e)
            }
        })
    })

    $('body').on('click','#list-type-rooms li', function(e) {
        $('#list-type-rooms li').removeClass('item-active');
        $(this).addClass('item-active');
        e.preventDefault();
        var data = getParamsFilter();
        $.ajax({
            type: "get",
            url: "{{route('rooms.index')}}",
            data: data,
            success: function (data) {
                $('#room-list').html('').html(data)
            },
            error: function (e) {
                console.log(e);
            }
        })
    });

    $('body').on('click','#list-floor li', function(e) {
        $('#list-floor li').removeClass('item-active');
        $(this).addClass('item-active');
        e.preventDefault();
        var data = getParamsFilter();
        $.ajax({
            type: "get",
            url: "{{route('rooms.index')}}",
            data: data,
            success: function (data) {
                $('#room-list').html('').html(data)
            },
            error: function (e) {
                console.log(e);
            }
        })
    })

    $('body').on('click', '#drop-down-order li', function(e) {
        $('#drop-down-order li').removeClass('item-active');
        $(this).addClass('item-active');
        e.preventDefault();
        var data = getParamsFilter();
        $.ajax({
            type: "get",
            url: "{{route('rooms.index')}}",
            data: data,
            success: function (data) {
                $('#room-list').html('').html(data)
            },
            error: function (e) {
                console.log(e);
            }
        })
    })

    $('body').on('click', '.group-customer-booking', function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: "{{route('groups.index')}}",
            success: function (data) {
                console.log('data', data)
                $('#group-customer-booking').html('').html(data);
                $('#group-customer-booking').modal('show');
                var start_date = $('#group-customer-booking').find('#start_date');
                var end_date = $('#group-customer-booking').find('#end_date');
                if (start_date) {
                    start_date.datetimepicker({
                        todayHighlight: true,
                        format: 'Y-m-d H:i',
                        startDate: new Date()
                    });
                }

                if (end_date) {
                    end_date.datetimepicker({
                        todayHighlight: true,
                        format: 'Y-m-d H:i',
                        endDate: new Date()
                    });
                }

            setTimeout(function () {
                $('#booking-room').find('#end_date').trigger('change');
            }, 300);

            },
            error: function (e) {
                console.log(e);
            }
        })
    });
    function checkSaleType(){

        var val = $( '#sale_type').val();
        if(val == 0) {
            $('form.row.g-3 #stock').attr('disabled', 'disabled');
        } else {
            $('form.row.g-3 #stock').removeAttr('disabled');
        }
    }
    checkSaleType();
    $('body').on('change', 'form.row.g-3 #sale_type', function(){
        checkSaleType();
    });

    $('body').on('click', '.btn-booking-group', function(e) {
        var modal = $(this).closest('.modal');
        var groupName = modal.find('#group_name').val();
        var note = modal.find('#note').val();
        var customerName = modal.find('#customer_name').val();
        var customerIdCard = modal.find('#customer_id_card').val();
        var customerPhone = modal.find('#customer_phone').val();
        var customerAddress = modal.find('#customer_address').val();
        var startDate = modal.find('#start_date').val();
        var endDate = modal.find('#end_date').val();
        var roomIds = [];

        $('input[name="room_ids[]"]:checked').map(function () {
            roomIds.push($(this).val());
        });

        if (groupName == '' || customerName == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '' || roomIds.length == undefined) {
            $.toast({
                text: 'Vui lòng nhập thông tin khách hàng.',
                icon: 'error',
                position: 'top-right'
            });

            $("#group-customer-booking input[type=text]").each(function () {
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
        } else if (startDate < endDate) {
            $('input[name="end_date"]').map(function () {
                $(this).removeClass('boder-validate');
            });
        }

        if (roomIds == '') {
            $.toast({
                text: 'Vui lòng chọn phòng cần đặt.',
                icon: 'error',
                position: 'top-right'
            });
            return false;
        }

        $.ajax({
            type: "POST",
            url: "{{route('booking-room.booking_room_group')}}",
            data: {
                group_name: groupName,
                note: note,
                customer_name: customerName,
                customer_id_card: customerIdCard,
                customer_phone: customerPhone,
                customer_address: customerAddress,
                start_date: startDate,
                end_date: endDate,
                room_ids: roomIds
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
                $.toast({
                    text: 'Thêm mới thành công',
                    icon: 'success',
                    position: 'top-right'
                });

                $("#group-customer-booking input[type=text]").each(function () {
                    $(this).val('');
                });

                $("#group-customer-booking .note").val('');

                $("#group-customer-booking input[type=checkbox]:checked").prop('checked', false);

                refreshView();
            },
            error: function (e) {
                console.log(e.lineNumber);
            }
        })
    });

    $('body').on('keyup', '#group_name', function(e) {
        var groupName = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{route('groups.filter')}}",
            data: {
                group_name: groupName
            },
            success: function(data) {
             $('#list-item-group').html('').html(data);
            },
            error: function(error) {
                console.log(error)
            }
        })
    })

    $('body').on('click', '#list-group-booking a', function(e) {
        var groupId = $(this).data('id');
        var modal = $(this).closest('.modal');
        $.ajax({
            type: "GET",
            url: "groups/" + groupId,
            success: function(data) {
                var group = data.group;
                $('#list-group-booking').html('');
                $('#group_name').val(group.name);
                $('#note').val(group.note);
                // modal.find('#customer_name').val(group.name);
                // modal.find('#customer_id_card').val(group.id_card);
                // modal.find('#customer_address').val(group.address);
                // modal.find('#customer_phone').val(group.phone);
                // modal.find('#start_date').val(group.start_date);
                // modal.find('#end_date').val(group.end_date);
            },
            error: function(error) {
                console.log(error)
            }
        })
    })

    function getParamsFilter () {
        var area = $('#list-floor .item-active').data('value');
        var type_room = $('#list-type-rooms .item-active').data('value');
        var order_by = $('#drop-down-order .item-active').data('value');
        return {
            area: area,
            type_room: type_room,
            order_by: order_by
        };
    }
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

    ul, ol {
        padding-left: 0;
    }

    .form-filter {
        padding: 22px 0px;
    }
    .item-active {
        background-color: #0d6efd;
    }
    .item-active a {
        color:#fff !important;
    }
    #list-group-customer a:hover {
        cursor: pointer;
    }
</style>

</body>
</html>
