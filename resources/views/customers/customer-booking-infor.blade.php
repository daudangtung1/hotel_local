<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" class="booking-modalLabel">Thông tin khách hàng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        <div class="modal-body row">
            <div class="col-md-6">
                <div class="row mt-3" id="form-booking-multiple">
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label fw-bold">Tên khách hàng:</label>
                        <p>{{$bookingRoomInfo->cusomter_name}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label fw-bold">Số giấy tờ:</label>
                        <p>{{$bookingRoomInfo->id_card}}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label fw-bold">Điện thoại:</label>
                        <p>{{$bookingRoomInfo->phone}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label fw-bold">Địa chỉ:</label>
                        <p>{{$bookingRoomInfo->address}}</p>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label fw-bold">Thời gian bắt
                                    đầu:</label>
                                <div class="form-group">
                                    <p>{{$bookingRoomInfo->start_date ?? \Carbon\Carbon::now()}}</p>
                                </div>
                            </div>
                            <div
                                class="col-md-6 "
                                id="box-end-date">
                                <label for="end_date" class="form-label fw-bold">Thời gian kết
                                    thúc:</label>
                                <div class="input-group date">
                                   <p>{{$bookingRoomInfo->end_date ?? \Carbon\Carbon::now()}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="price" class="form-label fw-bold">Ghi chú:</label>
                        <p>@if(!empty($bookingRoomInfo)) {!! $bookingRoomInfo->note ??'' !!} @endif </p>
                    </div>
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
            <button type="submit"class="btn btn-sm btn-primary" >
                Danh sách
            </button>
          </form>
                <button data-booking_room_id="{{$bookingRoomInfo->id}}" data-bg="primary" type="submit" class="btn btn-sm btn-primary  btn-checkin ">Nhận phòng</button>
        </div>
    </div>
</div>
