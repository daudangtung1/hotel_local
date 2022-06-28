@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Đồ thất lạc</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-toggle="modal" data-bs-target="#exampleModalLong">
                            Tạo mới
                        </button>
                    </div>
                    <div class="table-ajax">
                        @include('lost_item.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('body').on('click', '.btn-save', function (e) {
            e.preventDefault();

            var _this = $(this);
            var modal = _this.closest('.modal');
            var bookingRoomId = modal.find('.booking_room_id').val();
            var note = modal.find('.note').val();
            //
            // modal.find('.form-control').each(function () {
            //     if ($(this).hasClass('validate')) {
            //         if ($(this).val() == '') {
            //             $(this).addClass('boder-validate');
            //         } else if ($(this).hasClass('boder-validate')) {
            //             $(this).removeClass('boder-validate');
            //         }
            //     }
            // });
            //
            // $.toast({
            //     text: 'Vui lòng nhập đầy đủ thông tin',
            //     icon: 'error',
            //     position: 'top-right'
            // });
            // return false;

            $.ajax({
                type: "POST",
                url: "{{route('lost-items.store')}}",
                data: {
                    note: note,
                    booking_room_id: bookingRoomId,
                },
                success: function (data) {
                    modal.modal('hide');
                    $('.table-ajax').html(data);
                    $.toast({
                        text: 'Tạo thành công',
                        icon: 'success',
                        position: 'top-right'
                    });
                },
                error: function (e) {
                    console.log(e);
                }
            })
        });

        $('body').on('change', 'tr .status', function (e) {
            e.preventDefault();

            var _this = $(this);
            var tr = _this.closest('tr');
            var id = tr.data('lost_item_id');

            $.ajax({
                type: "GET",
                url: "/lost-items/update-status/" + id,
                data: {
                    id: id,
                },
                success: function (data) {
                    $('.table-ajax').html(data);
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

        $(document).ready(function () {
            var date = $('.filter-date');
            if (date) {
                date.datetimepicker({
                    todayHighlight: true,
                    format: 'Y-m-d',
                    startDate: new Date()
                });
            }
        });
    </script>
@endsection
