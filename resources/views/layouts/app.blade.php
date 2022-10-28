<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }}</title>
    <style>
        .datetime-picker {
            width: 130px !important;
        }

        .site-footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ffff;
            z-index: 9;
            padding-top: 25px;
        }

        .list-ajax,
        #list-item-customer {
            max-height: 300px;
            overflow: auto;
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            z-index: 9;
        }

        .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
        }

        .loader {
            margin: 60px auto;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(13, 110, 253, 0.2);
            border-right: 1.1em solid rgba(13, 110, 253, 0.2);
            border-bottom: 1.1em solid rgba(13, 110, 253, 0.2);
            border-left: 1.1em solid #0d6efd;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }

        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
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
    <link rel='stylesheet' href='https://anovavn.com/wpdemo/Hotel/wp-includes/css/dist/block-library/style.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Montserrat%3Awght%40100%3B200%3B300%3B400%3B500%3B600%3B700%3B800&#038;display=swap&#038;ver=6.0' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css' href="{{asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='nice-select-css-css' href="{{asset('vendors/nice-select/nice-select.css')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='datetimepicker-min-css-css' href="{{asset('vendors/datetimepicker/jquery.datetimepicker.min.css')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='animatecss-css' href="{{asset('assets/css/animate.css')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='maincss-css' href="{{asset('assets/css/main.css')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='custom-css-css' href="{{asset('assets/css/custom.css')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='dv-theme-style-css' href="{{asset('assets/css/style.css')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='jquery-ui-css' href='https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' type='text/css' media='all' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/css/bootstrap-datetimepicker.min.css" />

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
        .loading {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.8);
        }
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
    <div class="loading">
        <div class="loader">Loading...</div>
    </div>
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    @include('layouts.message')
    </div>
    <script src="{{asset('vendors/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('vendors/nice-select/jquery.nice-select.js')}}"></script>
    <script src="{{asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}" id='mainjs-js'></script>
    <script src="{{asset('vendors/slick/slick.min.js')}}" id='slick-js-js'></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/isotope.pkgd.js')}}" id='isotope-js-js'></script>
    <script src="{{asset('assets/js/main.js')}}" id='mainjs-js'></script>
    <script src="{{asset('assets/js/custom.js')}}" id='custom-js-js'></script>
    <script src="{{asset('js/core.min.js')}}"></script>
    <script src="{{asset('js/datepicker.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>

    @yield('script')
    <div class="modal fade" id="option-contact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
    <div class="modal fade" id="booking-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
    <div class="modal fade" id="group-customer-booking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
    <div class="modal fade" id="booking-room" aria-labelledby="booking-modalLabel" aria-hidden="true">
        @include('room.model-booking-room', ['bookingRoom' => null])
    </div>

    <div id="poup-booking-room"></div>

    <script>
        $(window).on('load', function() {
            closeLoading();
        });

        function loading() {
            $('.loading').fadeIn('fast');
        }

        function closeLoading() {
            $('.loading').fadeOut('fast');
        }

        function stopButton() {
            $('.btn').prop('disabled', true);
            loading();
        }

        function removeStopButton() {
            $('.btn').prop('disabled', false);
            closeLoading();
        }

        $(document).ready(function() {
            var dateTime = $('.datetime-picker');
            if (dateTime) {
                dateTime.datetimepicker({
                    todayHighlight: true,
                    format: 'Y-m-d H:i',
                    startDate: new Date()
                });
            }

            var date = $('.filter-date');
            if (date) {
                date.datetimepicker({
                    todayHighlight: true,
                    format: 'Y-m-d',
                    startDate: new Date()
                });
            }

            $('body').on('click', '.btn-booking-multiple-room', function() {
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
                $('input[name="room_ids[]"]:checked').map(function() {
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
                    $('input[name="end_date"]').map(function() {
                        $(this).addClass('boder-validate');
                    });
                    return false;
                } else if (startDate < endDate) {
                    $('input[name="end_date"]').map(function() {
                        $(this).removeClass('boder-validate');
                    });
                }

                if (customerName == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '' || startDate == '' || endDate == '') {
                    $.toast({
                        text: 'Vui lòng nhập thông tin khách hàng',
                        icon: 'error',
                        position: 'top-right'
                    });

                    $("#form-booking-multiple input[type=text]").each(function() {
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
                stopButton();
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
                    success: function(data) {
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
                        removeStopButton();
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            });

            function resetFormBooking() {
                var now = "{{\Carbon\Carbon::createFromFormat('Y-m-d H:i', \Carbon\Carbon::now()->format('Y-m-d H:i'))}}";
                $('#booking-room').find('#customer_name').val('');
                $('#booking-room').find('#customer_phone').val('');
                $('#booking-room').find('#customer_id_card').val('');
                $('#booking-room').find('#customer_address').val('');
                $('#booking-room').find('.note').val('');
                $('#booking-room').find('#start_date').val(now);
                $('#booking-room').find('#end_date').val(now);

                setTimeout(function() {
                    $('#booking-room').find('#end_date').trigger('change');
                }, 300);
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
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


            $('body').on('change', '.rentType', function(e) {
                e.preventDefault();
                var _this = $(this);
                var modal = _this.closest('.modal');
                var rentType = _this.val();

                if (rentType == 1 || rentType == 2) {
                    var now = "{{\Carbon\Carbon::createFromFormat('Y-m-d H:i', \Carbon\Carbon::now()->format('Y-m-d') . ' 12:00')}}";
                    var next = "{{\Carbon\Carbon::createFromFormat('Y-m-d H:i', \Carbon\Carbon::now()->addDay(1)->format('Y-m-d') . ' 12:00')}}";
                    modal.find('#start_date').val(now);
                    modal.find('#end_date').val(next);
                    modal.find('#box-end-date').removeClass('d-none');
                    modal.find('.extra-price-box').removeClass('d-none');
                } else {
                    var now = "{{\Carbon\Carbon::createFromFormat('Y-m-d H:i', \Carbon\Carbon::now()->format('Y-m-d H:i'))}}";
                    modal.find('#start_date').val(now);
                    modal.find('#end_date').val(now);
                    modal.find('#box-end-date').addClass('d-none');
                    modal.find('.extra-price-box').addClass('d-none');
                }
            });

            $('body').on('click', '.booking-room', function(e) {
                e.preventDefault();
                var roomTitle = $(this).find('.room-title').text();
                var floor = $(this).closest('.row-room').find('>h3').text();
                var roomId = $(this).attr('data-room-id');

                $('input[name="room_id"]').val(roomId);
                $('#booking-modal-' + roomId + ' .modal-title').text(roomTitle + ' - ' + floor);
            });

            var debounce = null;

            $('body').on('keyup', 'input[name="customer_name"]', function(e) {
              
                var _this = $(this);
                var form = _this.closest('.form-user');
                console.log(form.find('#customer_id_card').val(),form.find('#customer_phone').val());
                if (form.find('#customer_id_card').val() != '' && form.find('#customer_phone').val() != '') {
                    return false;
                }
                var customer_name = $(this).val();
                var modal = $(this).closest('.modal');
                var room_id = modal.find('input[name="room_id"]').val();

                $.ajax({
                    type: 'GET',
                    url: "{{route('customers.search')}}",
                    data: {
                        name: customer_name,
                        type: 'name'
                    },
                    success: function(data) {
                        modal.find('#list-item-customer').html('').html(data);
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            });

            $('body').on('keyup', '#customer_id_card', function(e) {
                var _this = $(this);
                var form = _this.closest('.form-user');
                if (form.find('#customer_name').val() != '' && form.find('#customer_phone').val() != '') {
                    return false;
                }

                var customer_name = $(this).val();
                var modal = $(this).closest('.modal');
                var room_id = modal.find('input[name="room_id"]').val();
                $.ajax({
                    type: 'GET',
                    url: "{{route('customers.search')}}",
                    data: {
                        name: customer_name,
                        type: 'id_card'
                    },
                    success: function(data) {
                        modal.find('#list-item-id_card').html('').html(data);
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            });

            $('body').on('keyup', '#customer_phone', function(e) {
                var _this = $(this);
                var form = _this.closest('.form-user');
                if (form.find('#customer_id_card').val() != '' && form.find('#customer_name').val() != '') {
                    return false;
                }
                var customer_name = $(this).val();
                var modal = $(this).closest('.modal');
                var room_id = modal.find('input[name="room_id"]').val();

                $.ajax({
                    type: 'GET',
                    url: "{{route('customers.search')}}",
                    data: {
                        name: customer_name,
                        type: 'phone'
                    },
                    success: function(data) {
                        modal.find('#list-item-phone').html('').html(data);
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            });


            $('body').on('click', '#list-group-customer a', function(e) {
                var modal = $(this).closest('.modal');
                var room_id = $(this).closest('.modal').find('input[name="room_id"]').val();
                var customer_id = $(this).data('id');
                stopButton();
                $.ajax({
                    type: 'GET',
                    url: "customers/" + customer_id,
                    dataType: "json",
                    success: function(data) {
                        var customer = data.customer;
                        modal.find('#customer_name').val(customer.name);
                        modal.find('#customer_address').val(customer.address);
                        modal.find('#customer_phone').val(customer.phone);
                        modal.find('#customer_id_card').val(customer.id_card);
                        modal.find('#list-group-customer').remove();
                        removeStopButton();
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            })

            function validateRoom(_this) {
                var endDate = _this.closest('.row').find('#end_date').val();
                var startDate = _this.closest('.row').find('#start_date').val();
                stopButton();
                $.ajax({
                    type: "GET",
                    url: "{{route('booking-room.index')}}",
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(data) {
                        $('#list-booking-room').html('').html(data);
                        $('#preloader').fadeOut();
                        removeStopButton();
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            }

            $('body').on('change', '#end_date, #start_date', function(e) {
                e.preventDefault();
                $('#preloader').css('background-color', 'rgba(255,255,255,0.8)').show();
                validateRoom($(this));
            })

            $('body').on('click', '.btn-checkin', function(e) {
                e.preventDefault();
                var bookingRoomId = $(this).attr('data-booking_room_id');
                var modal = $(this).closest('.modal');
                stopButton();
                $.ajax({
                    type: "GET",
                    url: "{{route('booking-room.booking')}}",
                    data: {
                        booking_room_id: bookingRoomId,
                    },
                    success: function(data) {
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
                        removeStopButton();
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            })

            $('body').on('shown.bs.modal', '#booking-room', function(e) {
                setTimeout(function() {
                    $('#booking-room').find('#end_date').trigger('change');
                }, 500)
                var now = "{{\Carbon\Carbon::createFromFormat('Y-m-d H:i', \Carbon\Carbon::now()->format('Y-m-d H:i'))}}";
                $(this).find('#customer_name').val('');
                $(this).find('#customer_phone').val('');
                $(this).find('#customer_id_card').val('');
                $(this).find('#customer_address').val('');
                $(this).find('.note').val('');
                $(this).find('#start_date').val(now);
                $(this).find('#end_date').val(now);
            })

            setInterval(function() {
                $.ajax({
                    type: "get",
                    url: "{{route('rooms.getMinutes')}}",
                    dataType: "json",
                    success: function(data) {
                        data.map(function(el, key) {
                            $('#room-' + el.room_id).find('#start_date .text').html(el.start_date);
                            $('#room-' + el.room_id).find('#minutes .text').html(el.minutes);
                            $('#room-' + el.room_id).find('#total_price .text').html(el.price);
                        });
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }, 600000);

            $('body').on('click', '.btn-add-customer', function(e) {
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
                stopButton();
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
                    success: function(data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                        refreshView();
                        removeStopButton();
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            });

            $('body').on('click', '.btn-booking-room', function(e) {
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
                    $("#form-booking input[type=text]").each(function() {
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
                stopButton();
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
                    success: function(data) {
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

                        refreshView();
                        removeStopButton();
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            });

            $('body').on('click', '.modal table input[name="select"]', function(e) {
                e.preventDefault();
                var _this = $(this);
                var modal = _this.closest('.modal');
                var roomId = modal.find('input[name="room_id"]').val();
                var serviceId = _this.val();
                console.log(serviceId);

            });

            $('body').on('click', '.model-btn-update-service', function(e) {
                var _this = $(this);
                var modal = _this.closest('.modal');
                var serviceId = _this.data('service-id');
                var tr = _this.closest('tr');
                var modalStartDate = tr.find('.modal_start_date').val();
                var modalEndDate = tr.find('.modal_end_date').val();
                var href = _this.data('url_update');
                var roomId = modal.find('input[name="room_id"]').val();

                if (modalStartDate == '' || modalEndDate == '') {
                    _this.closest('tr').find('td .row').removeClass('d-none');
                    $.toast({
                        text: 'Vui lòng nhập ngày bắt đầu và kết thúc',
                        icon: 'error',
                        position: 'top-right'
                    });
                    return false;
                }

                if (modalStartDate == modalEndDate) {
                    _this.closest('tr').find('td .row').removeClass('d-none');
                    $.toast({
                        text: 'Ngày bắt đầu phải bé thua ngày kết thúc',
                        icon: 'error',
                        position: 'top-right'
                    });
                    return false;
                }
                stopButton();
                $.ajax({
                    type: "POST",
                    url: href,
                    data: {
                        "_method": 'PUT',
                        modalStartDate: modalStartDate,
                        modalEndDate: modalEndDate,
                    },
                    success: function(data) {
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
                        removeStopButton();
                        $('.datetime-picker').datetimepicker({
                            todayHighlight: true,
                            format: 'Y-m-d H:i',
                            startDate: new Date()
                        });
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            });

            $('body').on('keyup', 'input[name="quantity_service"]', function(e) {
                var _this = $(this);
                var modal = _this.closest('.modal');
                var quantityService = _this.val().replace(/^\s+|\s+$/g, "");
                var href = _this.data('url_update');
                var roomId = modal.find('input[name="room_id"]').val();

                if (quantityService == '0') {
                    $(this).val(1);
                    quantityService = 1;
                }
                $.ajax({
                    type: "POST",
                    url: href,
                    data: {
                        "_method": 'PUT',
                        quantity: quantityService,
                    },
                    success: function(data) {
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
                    error: function(e) {
                        console.log(e);
                    }
                })
            });

            $('body').on('click', '.modal tr .model-btn-add-service', function(e) {
                e.preventDefault();

                var _this = $(this);
                var modal = _this.closest('.modal');
                var td = _this.closest('tr');

                var roomId = modal.find('input[name="room_id"]').val();
                var modalStartDate = td.find('.modal_start_date').val();
                var modalEndDate = td.find('.modal_end_date').val();
                var modalServiceId = td.find('.modal_service_id').val();

                if (modalStartDate == '' || modalEndDate == '' || modalStartDate == modalEndDate) {
                    _this.closest('tr').find('td .row').removeClass('d-none');
                    $.toast({
                        text: 'Vui lòng nhập ngày bắt đầu và kết thúc',
                        icon: 'error',
                        position: 'top-right'
                    });
                    return false;
                }

                if (modalEndDate <= modalStartDate) {
                    $.toast({
                        text: 'Ngày bắt đầu phải bé thua ngày kết thúc',
                        icon: 'error',
                        position: 'top-right'
                    });
                    return false;
                }
                stopButton();
                $.ajax({
                    type: "POST",
                    url: "{{route('booking-room.store')}}",
                    data: {
                        room_id: roomId,
                        service_id: modalServiceId,
                        modal_end_date: modalEndDate,
                        modal_start_date: modalStartDate,
                    },
                    success: function(data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);
                        changeBgLi(_this, roomId);
                        refreshView();
                        removeStopButton();
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            });

            $('body').on('click', '.btn-add-service', function(e) {
                e.preventDefault();

                var _this = $(this);
                var modal = _this.closest('.modal');
                var tr = _this.closest('tr');
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
                var modalStartDate = tr.find('.modal_start_date').val();
                var modalEndDate = tr.find('.modal_end_date').val();

                _this.closest('tbody').find('td .row').addClass('d-none');
                _this.closest('tbody').find('.modal_end_date').val('');
                _this.closest('tbody').find('.modal_start_date').val('');


                if (saleType == 0 && (modalStartDate == '' || modalEndDate == '' || modalEndDate == modalStartDate)) {
                    _this.closest('tr').find('td .row').removeClass('d-none');
                    return false;
                }
                stopButton();
                $.ajax({
                    type: "POST",
                    url: "{{route('booking-room.store')}}",
                    data: {
                        room_id: roomId,
                        service_id: serviceId,
                        start_date: startDate,
                        end_date: endDate,
                    },
                    success: function(data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);
                        changeBgLi(_this, roomId);
                        refreshView();
                        removeStopButton();
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            });

            $('body').on('click', '.btn-ajax-delete-customer', function(e) {
                e.preventDefault();
                var _this = $(this);
                var modal = _this.closest('.modal');
                var bookingRoomServiceId = _this.data('booking_room_service_id');
                var roomId = modal.find('input[name="room_id"]').val();
                var href = _this.attr('href');
                stopButton();
                $.ajax({
                    type: "POST",
                    url: href,
                    data: {
                        "_method": 'DELETE',
                        room_id: roomId,
                        booking_room_service_id: bookingRoomServiceId,
                    },
                    success: function(data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);
                        changeBgLi(_this, roomId);
                        refreshView();
                        removeStopButton();
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            });

            $('body').on('click', '.btn-remove-service', function(e) {
                e.preventDefault();
                var _this = $(this);
                var modal = _this.closest('.modal');
                var bookingRoomServiceId = _this.data('booking_room_service_id');
                var roomId = modal.find('input[name="room_id"]').val();
                var href = _this.attr('href');
                stopButton();
                $.ajax({
                    type: "POST",
                    url: href,
                    data: {
                        "_method": 'DELETE',
                        room_id: roomId,
                        booking_room_service_id: bookingRoomServiceId,
                    },
                    success: function(data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);
                        changeBgLi(_this, roomId);
                        refreshView();
                        removeStopButton();
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                })
            });

            $('body').on('click', '.btn-change-status', function(e) {
                e.preventDefault();
                var _this = $(this);
                var modal = _this.closest('.modal');
                var roomId = modal.find('input[name="room_id"]').val();
                var moneyReceived = modal.find('input[name="money_received"]').val();
                var moneyUnpaid = modal.find('input[name="money_unpaid"]').val();
                var href = _this.data('action');

                stopButton();
                $.ajax({
                    type: "POST",
                    url: href,
                    data: {
                        room_id: roomId,
                        money_received: moneyReceived,
                        money_unpaid: moneyUnpaid,
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.toast({
                                text: data.massage,
                                icon: 'error',
                                position: 'top-right'
                            });
                            removeStopButton();
                            return false;
                        }
                        _this.closest('.modal').find('.modal-dialog').html(data);
                        refreshView();
                        removeStopButton();
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
                    }
                });
            });


            $('body').on('click', '.btn-update', function(e) {
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
                stopButton();
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
                    success: function(data) {
                        _this.closest('.modal').find('.modal-dialog').html(data);
                        changeBgLi(_this, roomId);
                        refreshView();
                        removeStopButton();
                        $.toast({
                            text: 'Cập nhật thành công',
                            icon: 'success',
                            position: 'top-right'
                        });
                    },
                    error: function(e) {
                        console.log(e);
                        removeStopButton();
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
                success: function(data) {
                    $('#room-list').html('').html(data);
                },
                error: function(e) {
                    console.log(e);
                }
            })
        }

        $('body').on('click', '.contact', function() {
            stopButton();
            $.ajax({
                type: "get",
                url: "{{route('options.index')}}",
                success: function(data) {
                    $('#option-contact').html('').html(data);
                    $('#option-contact').modal('show');
                    removeStopButton();
                },
                error: function(e) {
                    console.log(e);
                    removeStopButton();
                }
            })
        })

        $('body').on('click', '#list-type-rooms li', function(e) {
            $('#list-type-rooms li').removeClass('item-active');
            $(this).addClass('item-active');
            e.preventDefault();
            var data = getParamsFilter();
            stopButton();
            $.ajax({
                type: "get",
                url: "{{route('rooms.index')}}",
                data: data,
                success: function(data) {
                    $('#room-list').html('').html(data);
                    removeStopButton();
                },
                error: function(e) {
                    console.log(e);
                    removeStopButton();
                }
            })
        });

        $('body').on('click', '#list-floor li', function(e) {
            $('#list-floor li').removeClass('item-active');
            $(this).addClass('item-active');
            e.preventDefault();
            var data = getParamsFilter();
            stopButton();
            $.ajax({
                type: "get",
                url: "{{route('rooms.index')}}",
                data: data,
                success: function(data) {
                    $('#room-list').html('').html(data);
                    removeStopButton();
                },
                error: function(e) {
                    console.log(e);
                    removeStopButton();
                }
            })
        })

        $('body').on('click', '#drop-down-order li', function(e) {
            $('#drop-down-order li').removeClass('item-active');
            $(this).addClass('item-active');
            e.preventDefault();
            var data = getParamsFilter();
            stopButton();
            $.ajax({
                type: "get",
                url: "{{route('rooms.index')}}",
                data: data,
                success: function(data) {
                    $('#room-list').html('').html(data);
                    removeStopButton();
                },
                error: function(e) {
                    console.log(e);
                    removeStopButton();
                }
            })
        })

        $('body').on('click', '.group-customer-booking', function(e) {
            e.preventDefault();
            stopButton();
            $.ajax({
                type: "get",
                url: "{{route('groups.index')}}",
                success: function(data) {
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
                    removeStopButton();
                    setTimeout(function() {
                        $('#booking-room').find('#end_date').trigger('change');
                    }, 300);

                },
                error: function(e) {
                    console.log(e);
                    removeStopButton();
                }
            })
        });

        function checkSaleType() {
            var val = $('#sale_type').val();
            if (val == 0) {
                $('form.row.g-3 #stock').attr('disabled', 'disabled');
            } else {
                $('form.row.g-3 #stock').removeAttr('disabled');
            }
        }

        checkSaleType();

        $('body').on('change', 'form.row.g-3 #sale_type', function() {
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

            $('input[name="room_ids[]"]:checked').map(function() {
                roomIds.push($(this).val());
            });

            if (groupName == '' || customerName == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '' || roomIds.length == undefined) {
                $.toast({
                    text: 'Vui lòng nhập thông tin khách hàng.',
                    icon: 'error',
                    position: 'top-right'
                });

                $("#group-customer-booking input[type=text]").each(function() {
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
                $('input[name="end_date"]').map(function() {
                    $(this).addClass('boder-validate');
                });
                return false;
            } else if (startDate < endDate) {
                $('input[name="end_date"]').map(function() {
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
            stopButton();
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
                success: function(data) {
                    if (typeof data.response !== 'undefined') {
                        $.toast({
                            text: data.response.message,
                            icon: 'error',
                            position: 'top-right'
                        });
                        return false;
                    }


                    $("#group-customer-booking input[type=text]").each(function() {
                        $(this).val('');
                    });

                    $("#group-customer-booking .note").val('');

                    $("#group-customer-booking input[type=checkbox]:checked").prop('checked', false);

                    refreshView();
                    removeStopButton();
                    $.toast({
                        text: 'Thêm mới thành công',
                        icon: 'success',
                        position: 'top-right'
                    });
                },
                error: function(e) {
                    console.log(e.lineNumber);
                    removeStopButton();
                }
            })
        });

        $('body').on('keyup', '#group_name', function(e) {
            var groupName = $(this).val();
            var _this = $(this);
            $.ajax({
                type: "GET",
                url: "{{route('groups.filter')}}",
                data: {
                    group_name: groupName
                },
                success: function(data) {
                    _this.closest('.modal').find('.list-ajax').html('').html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        })
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

        $('body').on('click', '.show-room-popup', function(e) {
            var roomUrl = $(this).data('room_url');
            stopButton();
            $.ajax({
                type: "get",
                url: roomUrl,
                success: function (data) {
                  $('#poup-booking-room').html('').html(data);
                  $('#poup-booking-room .modal').modal('show');
                  removeStopButton();
                },
                error: function (e) {
                    console.log(e);
                    removeStopButton();
                    $('#poup-booking-room .modal').modal('hide');
                }
            })
        });

        $('.modal').on('hide.bs.modal', function (e) {
            console.log('Modal close event.')
            $(this).closest('#poup-booking-room').html('');
        });

        $('body').on('click', '#list-group-booking a', function(e) {
            var groupId = $(this).data('id');
            var modal = $(this).closest('.modal');
            stopButton();
            $.ajax({
                type: "GET",
                url: "groups/" + groupId,
                success: function(data) {
                    var group = data.group;
                    $('#list-group-booking').html('');
                    $('#group_name').val(group.name);
                    $('#note').val(group.note);
                    removeStopButton();
                },
                error: function(error) {
                    console.log(error);
                    removeStopButton();
                }
            })
        })

        function getParamsFilter() {
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
                max-width: 90vw;
            }
        }

        td a svg {
            width: 15px;
            height: 15px;
        }

        ul,
        ol {
            padding-left: 0;
        }

        .form-filter {
            padding: 22px 0px;
        }

        .item-active {
            background-color: #0d6efd;
        }

        .item-active a {
            color: #fff !important;
        }

        #list-group-customer a:hover {
            cursor: pointer;
        }
    </style>
</body>

</html>