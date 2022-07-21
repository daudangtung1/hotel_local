<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" class="booking-modalLabel">Khách đoàn</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        <div class="modal-body row">
            <div class="col-md-6">
                <h5>Thông tin đoàn</h5>
                <div class="row mt-3" id="form-create-group">
                    <div class="col-md-6 mb-3 position-relative">
                        <input type="text" class="form-control  form-control-sm validate" id="group_name"
                            name="group_name" required
                            placeholder="Tên đoàn">
                        <div class="col-md-12 mb-3" id="list-item-group"></div>
                    </div>
                <div class="col-md-12 mb-3">
                    <textarea name="note" class="form-control form-control-sm note" cols="30" rows="2" id="note"
                            placeholder="Ghi chú"></textarea>
                </div>
                </div>

                <h5>Thông tin người đặt</h5>
                <div class="row mt-3" id="form-booking-group">
                    <div class="col-md-6 mb-3 position-relative">
                        <input type="text" class="form-control  form-control-sm validate" id="customer_name"
                            name="customer_name" required
                            placeholder="Tên khách hàng">
                        <div class="col-md-12 mb-3" id="list-item-customer"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control  form-control-sm validate" id="customer_id_card"
                            name="customer_id_card" required
                            placeholder="Số giấy tờ">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control  form-control-sm validate" id="customer_phone"
                            name="customer_phone" required
                            placeholder="Điện thoại">
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control  form-control-sm validate" id="customer_address"
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
            <button class="btn btn-sm btn-primary btn-booking-group">Đặt phòng</button>
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
