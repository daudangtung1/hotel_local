@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>{{$title ?? ''}}</h5>
                        <div class="filter">
                            <form action="" class="d-flex" method="GET">
                                <input type="text" name="name" class="form-control form-control-sm me-2" placeholder="Tên khách hàng" value="@if(!empty(request()->name)) {{request()->name}} @endif">
                                <input type="text" class="form-control form-control-sm me-2 " placeholder="Phòng" name="room" value="@if(!empty(request()->room)) {{request()->room}} @endif"  autocomplete="off">

                                <button class="btn btn-success me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                    </svg>Lọc</button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Tên phòng</th>
                            <th scope="col">Thời gian</th>
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
                                    <td>
                                        <p><b>Phòng</b> {{$bookingRoom->room->name ?? ''}}</p>
                                        <p><b>Tầng:</b> {{$bookingRoom->room->floor ?? ''}}</p>
                                    </td>
                                    <td>
                                        <p><b>Ngày vào: </b>{{$bookingRoom->start_date ?? ''}}</p>
                                        <p><b>Ngày ra: </b>{{$bookingRoom->end_date ?? ''}}</p>
                                    </td>
                                    <td>
                                        @foreach($bookingRoom->bookingRoomCustomers()->get() as $customer)
                                            <p>{{$customer->customer->name ?? ''}}</p>
                                        @endforeach
                                    </td>
                                    <td>{{$bookingRoom->note ?? ''}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('booking-room.show_invoice', $bookingRoom->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Không có dữ liệu</td>
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
