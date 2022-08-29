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
                <div class="row mt-3" id="form-booking-multiple">
                    <div class="col-md-6 mb-3 position-relative">
                        <input type="text" class="form-control form-control-sm validate" id="customer_name" autocomplete="Off" 
                            name="customer_name" required
                            placeholder="Tên khách hàng">
                        <div class="col-md-12 mb-3 list-ajax" id="list-item-customer"></div>
                    </div>
                    <div class="col-md-6 mb-3 position-relative">
                        <input type="text" class="form-control form-control-sm validate" id="customer_id_card"
                            name="customer_id_card" required
                            placeholder="Số giấy tờ">
                            <div class="col-md-12 mb-3 list-ajax" id="list-item-id_card"></div>
                    </div>

                    <div class="col-md-6 mb-3 position-relative">
                        <input type="text" class="form-control form-control-sm validate" id="customer_phone"
                            name="customer_phone" required
                            placeholder="Điện thoại">
                            <div class="col-md-12 mb-3 list-ajax" id="list-item-phone"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control form-control-sm validate" id="customer_address"
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
                                    <input type="text" id="end_date" name="end_date"
                                        class="form-control  form-control-sm datetime-picker validate-date "
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
                <div class="div-scroll max-height-300 mb-3" id="list-booking-room">
                    @include('room.list-booking-room')
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
