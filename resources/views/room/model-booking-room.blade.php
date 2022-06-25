<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" class="booking-modalLabel">Đặt phòng trước cho khách hàng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        <div class="modal-body row">
            <div class="col-md-6">
                <h5>Thông tin khách hàng</h5>
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control  form-control-sm" id="customer_name"
                               name="customer_name" required
                               placeholder="Tên khách hàng">
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control  form-control-sm" id="customer_id_card"
                               name="customer_id_card" required
                               placeholder="Số giấy tờ">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control  form-control-sm" id="customer_phone"
                               name="customer_phone" required
                               placeholder="Điện thoại">
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control  form-control-sm" id="customer_address"
                               name="customer_address" required placeholder="Địa chỉ">
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Thời gian bắt
                                    đầu:</label>
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="text" id="start_date"
                                               class="form-control  form-control-sm datetime-picker"
                                               value="{{\Carbon\Carbon::now()}}">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-md-6 "
                                id="box-end-date">
                                <label for="end_date" class="form-label">Thời gian kết
                                    thúc:</label>
                                <div class="input-group date">
                                    <input type="text" id="end_date"
                                           class="form-control  form-control-sm datetime-picker"
                                           value="{{\Carbon\Carbon::now()}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="price" class="form-label">Ghi chú:</label>
                        <textarea name="note" class="form-control  form-control-sm note" cols="30" rows="2"
                                  placeholder="Ghi chú">@if(!empty($bookingRoom)) {!! $bookingRoom->note ??'' !!} @endif </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Danh sách phòng</h5>
                <div class="div-scroll max-height-300 mb-3">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên phòng</th>
                            <th scope="col">Tầng</th>
                            <th scope="col">Giá theo giờ</th>
                            <th scope="col">Giá theo ngày</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($floors))
                            @forelse($floors as $key => $rooms)
                                @foreach($rooms as $room)
                                    <tr>
                                        <td><input type="checkbox" name="room_ids[]" value="{{$room->id ??''}}"></td>
                                        <td>{{$room->name ??'Đã xóa'}}</td>
                                        <td>{{$room->floor ??'Đã xóa'}}</td>
                                        <td>{{get_price($room->hour_price ?? 0, 'đ')}}</td>
                                        <td>{{get_price($room->day_price ?? 0, 'đ')}}</td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="2">Không có phòng nào</td>
                                </tr>
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                Đóng
            </button>

            <a href="{{route('booking-room.index')}}" class="btn btn-sm btn-success">Quản lý đặt phòng</a>

            <button class="btn btn-sm btn-primary btn-booking-multiple-room">Đặt phòng</button>
        </div>
    </div>
</div>
