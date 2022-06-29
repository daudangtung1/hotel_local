@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Quản lý đặt phòng đã sử dụng</h5>
                        <a href="{{route('booking-room.index')}}" class="btn btn-light">Quay lại</a>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Tên phòng</th>
                            <th scope="col">Tầng</th>
                            <th scope="col">Ngày nhận phòng</th>
                            <th scope="col">Ngày trả phòng</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Ghi chú</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($bookingRooms))
                            @forelse($bookingRooms as $key => $bookingRoom)
                                <tr>
                                    <td>
                                        <a href="{{ route('booking-room.show_invoice', $bookingRoom->id) }}">
                                            {{$bookingRoom->room->name ??''}}
                                        </a>
                                    </td>
                                    <td>{{$bookingRoom->room->floor ??''}}</td>
                                    <td>{{$bookingRoom->start_date ?? ''}}</td>
                                    <td>{{$bookingRoom->end_date ?? ''}}</td>
                                    <td>
                                        @foreach($bookingRoom->bookingRoomCustomers()->get() as $customer)
                                            <p>{{$customer->customer->name ?? ''}}</p>
                                        @endforeach
                                    </td>
                                    <td>{{$bookingRoom->note ?? ''}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Không có phòng nào</td>
                                </tr>
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        {{ $bookingRooms->links('pagination::bootstrap-4') }}
                    </div>
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
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
