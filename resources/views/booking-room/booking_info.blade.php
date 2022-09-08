@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>{{$title}}</h5>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Sdt</th>
                            <th scope="col">Thông tin giấy tờ</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Phòng</th>
                            <th scope="col">Ngày bắt đầu</th>
                            <th scope="col">Ngày kết thúc</th>
                            <th scope="col">Ghi chú</th>        
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($customerInfoBookingRooms))
                            @forelse($customerInfoBookingRooms as $key => $customer)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$customer->cusomter_name}}</td>
                                    <td>{{$customer->phone ??''}}</td>
                                    <td>{{$customer->id_card ??''}}</td>
                                    <td>{{$customer->address ??''}}</td>
                                    <td>{{$customer->name ?? ''}}</td>
                                    <td>{{$customer->start_date ?? ''}}</td>
                                    <td>{{$customer->end_date ?? ''}}</td>
                                    <td>{{$customer->note ?? ''}}</td>
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
                        {{ $customerInfoBookingRooms->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
