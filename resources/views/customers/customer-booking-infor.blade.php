<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" class="booking-modalLabel">Thông tin khách hàng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row">
            <div class="col-md-6">
                <div class="row mt-3" id="form-booking-multiple">
                    <table class="table table-sm table-bordered table-hover">
                        <tr>
                            <th>Tên khách hàng:</th>
                            <td>{{$bookingRoomInfo->cusomter_name}}</td>
                        </tr>
                        <tr>
                            <th>Số giấy tờ:</th>
                            <td>{{$bookingRoomInfo->id_card}}</td>
                        </tr>
                        <tr>
                            <th>Điện thoại:</th>
                            <td>{{$bookingRoomInfo->phone}}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td>{{$bookingRoomInfo->address}}</td>
                        </tr>
                        <tr>
                            <th>Số giấy tờ:</th>
                            <td>{{$bookingRoomInfo->id_card}}</td>
                        </tr>
                        <tr>
                            <th>Số giấy tờ:</th>
                            <td>{{$bookingRoomInfo->id_card}}</td>
                        </tr>
                        <tr>
                            <th>Thời gian bắt đầu:</th>
                            <td>{{$bookingRoomInfo->start_date ?? \Carbon\Carbon::now()}}</td>
                        </tr>
                        <tr>
                            <th>Thời gian kết thúc:</th>
                            <td>{{$bookingRoomInfo->end_date ?? \Carbon\Carbon::now()}}</td>
                        </tr>
                        <tr>
                            <th>Ghi chú:</th>
                            <td>@if(!empty($bookingRoomInfo)) {!! $bookingRoomInfo->note ??'' !!} @endif </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Thông tin phòng</h5>
                <div class="max-height-300 mb-3" id="list-booking-room">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Tên phòng</th>
                                <th scope="col">Tầng</th>
                                <th scope="col">Giá theo giờ</th>
                                <th scope="col">Giá theo ngày</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$bookingRoomInfo->id}}</td>
                                <td>{{$bookingRoomInfo->room_name ??'Đã xóa'}}</td>
                                <td>{{$bookingRoomInfo->floor ??'Đã xóa'}}</td>
                                <td>{{get_price($bookingRoomInfo->hour_price ?? 0, 'đ')}}</td>
                                <td>{{get_price($bookingRoomInfo->day_price ?? 0, 'đ')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                Đóng
            </button>
            <form method="get" action="{{route('customers.booking_info')}}">
                <input type="hidden" name="room_id" value="{{$bookingRoomInfo->room_id}}" />
                <button type="submit" class="btn btn-sm btn-primary">
                    Danh sách
                </button>
            </form>
            <button data-booking_room_id="{{$bookingRoomInfo->id}}" data-bg="primary" type="submit" class="btn btn-sm btn-primary  btn-checkin ">Nhận phòng</button>
        </div>
    </div>
</div>