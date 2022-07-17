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
                        <label for="end_date" class="form-label">Tên khách hàng:</label>
                        <input type="text" class="form-control form-control-sm validate" id="customer_name"
                            name="customer_name" required
                            value="{{$bookingRoomInfo->cusomter_name}}"
                            placeholder="Tên khách hàng">
                        <div class="col-md-12 mb-3" id="list-item-customer"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Số giấy tờ:</label>
                        <input type="text" class="form-control  form-control-sm validate" id="customer_id_card"
                            name="customer_id_card" 
                            value="{{$bookingRoomInfo->id_card}}"
                            required
                            placeholder="Số giấy tờ">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Điện thoại:</label>
                        <input type="text" class="form-control  form-control-sm validate" id="customer_phone"
                            name="customer_phone" 
                            value="{{$bookingRoomInfo->phone}}" required
                            placeholder="Điện thoại">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control  form-control-sm validate" id="customer_address"
                            value="{{$bookingRoomInfo->address}}" required
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
                                            class="form-control  form-control-sm datetime-picker validate-date "
                                            value="{{$bookingRoomInfo->start_date ?? \Carbon\Carbon::now()}}">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-md-6 "
                                id="box-end-date">
                                <label for="end_date" class="form-label">Thời gian kết
                                    thúc:</label>
                                <div class="input-group date">
                                    <input type="text" id="end_date" name="end_date"
                                        class="form-control  form-control-sm datetime-picker validate-date "
                                        value="{{$bookingRoomInfo->end_date ?? \Carbon\Carbon::now()}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="price" class="form-label">Ghi chú:</label>
                        <textarea name="note" class="form-control  form-control-sm note" cols="30" rows="2"
                                placeholder="Ghi chú">@if(!empty($bookingRoomInfo)) {!! $bookingRoomInfo->note ??'' !!} @endif </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Thông tin phòng</h5>
                <div class="max-height-300 mb-3" id="list-booking-room">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Tên phòng</th>
                            <th scope="col">Tầng</th>
                            <th scope="col">Giá theo giờ</th>
                            <th scope="col">Giá theo ngày</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($floors))
                            <tr>
                                <td>{{$bookingRoomInfo->room_name ??'Đã xóa'}}</td>
                                <td>{{$bookingRoomInfo->floor ??'Đã xóa'}}</td>
                                <td>{{get_price($bookingRoomInfo->hour_price ?? 0, 'đ')}}</td>
                                <td>{{get_price($bookingRoomInfo->day_price ?? 0, 'đ')}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script>
        $(document).ready(function () {
            var date = $('.datetime-picker');
            if (date) {
                date.datetimepicker({
                    todayHighlight: true,
                    format: 'Y-m-d H:i',
                    startDate: new Date()
                });
            }
        });
    </script>
@endsection
