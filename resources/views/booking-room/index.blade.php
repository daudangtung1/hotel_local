@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Quản lý đặt phòng</h5>
                        <a href="{{route('booking-room.history')}}" class="btn btn-info">Lịch sử đặt phòng</a>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Tên phòng</th>
                            <th scope="col">Tầng</th>
                            <th scope="col">Ngày nhận phòng</th>
                            <th scope="col">Ngày trả phòng</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Ghi chú</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($bookingRooms))
                            @forelse($bookingRooms as $key => $bookingRoom)
                                <tr>
                                    <td>{{$bookingRoom->id}}</td>
                                    <td>{{$bookingRoom->room->name ??''}}</td>
                                    <td>{{$bookingRoom->room->floor ??''}}</td>
                                    <td>{{$bookingRoom->start_date ?? ''}}</td>
                                    <td>{{$bookingRoom->end_date ?? ''}}</td>
                                    <td>
                                        @foreach($bookingRoom->bookingRoomCustomers()->get() as $customer)
                                            <p>{{$customer->customer->name ?? ''}}</p>
                                        @endforeach
                                    </td>
                                    <td>{{$bookingRoom->note ?? ''}}</td>
                                    <td style="width:40px">
                                        <div class="d-flex">
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#booking-room-{{$bookingRoom->id}}" class=" text-warning mr-2 d-inline-block" style="margin-right: 5px;"
                                               href="{{route('booking-room.edit',['booking_room' => $bookingRoom])}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                            </a>
                                            <form action="{{route('booking-room.destroy',['booking_room' => $bookingRoom])}}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <a href="" class="btn-ajax-delete text-danger  btn-sm ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd"
                                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </a>
                                            </form>
                                        </div>
                                        <div class="modal fade" id="booking-room-{{$bookingRoom->id}}"
                                             aria-labelledby="booking-modalLabel" aria-hidden="true">
                                            @include('room.model-booking-room', ['bookingRoom' => $bookingRoom ?? null])
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Không có phòng nào</td>
                                </tr>
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('body').on('click', '.btn-ajax-delete', function (e) {
                                e.preventDefault();
                                if (!confirm('Bạn chắc chắn muốn xóa chứ?')) {
                                    return false;
                                }

                                $(this).closest('form').submit();
                            })
                        });
                        // If the updated modal is showing, only 1 room can be selected
                        $("div[id^='booking-room-']").on('shown.bs.modal', function(e) {
                            $(this).on('click', 'input[type="checkbox"][name="room_ids[]"]', function() {      
                                $('input[type="checkbox"][name="room_ids[]"]').not(this).prop('checked', false);      
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
