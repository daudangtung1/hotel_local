@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>{{__('Lost_item')}}</h5>
                        @can('Quản lý đồ thất lạc-create')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-toggle="modal" data-bs-target="#exampleModalLong">
                            {{__('Create')}}
                        </button>
                        @endcan
                    </div>
                    @can('Quản lý đồ thất lạc-list')
                    <div class="table-ajax">
                        @include('lost_item.table')
                    </div>
                    @endcan
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
            if (bookingRoomId == '' || note == '' ) {
                $.toast({
                    text: "{{__('Msg_enter_full_information')}}",
                    icon: 'error',
                    position: 'top-right'
                });
                return false;
            }
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
        @can('Quản lý đồ thất lạc-update')
        $('body').on('change', '.note', function (e) {
            e.preventDefault();

            var _this = $(this);
            var tr = _this.closest('tr');
            var id = tr.data('lost_item_id');
            var note = _this.val();
            var status = tr.find('.status').val();

            $.ajax({
                type: "GET",
                url: "/lost-items/update-status/" + id,
                data: {
                    id: id,
                    note:note,
                    status:status,
                },
                success: function (data) {
                    $('.table-ajax').html(data);
                    $.toast({
                        text: "{{__('Msg_update_success')}}",
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
            var status = _this.val();

            $.ajax({
                type: "GET",
                url: "/lost-items/update-status/" + id,
                data: {
                    id: id,
                    status: status,
                },
                success: function (data) {
                    $('.table-ajax').html(data);
                    $.toast({
                        text: "{{__('Msg_update_success')}}",
                        icon: 'success',
                        position: 'top-right'
                    });
                },
                error: function (e) {
                    console.log(e);
                }
            })
        });
        @endcan
    </script>
@endsection
