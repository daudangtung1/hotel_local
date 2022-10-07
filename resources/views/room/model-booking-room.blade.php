@if(!empty($bookingRoom))
    <form action="{{route('booking-room.update',['booking_room' => $bookingRoom])}}" method="POST">
        {{method_field('PUT')}}
        @csrf
@endif
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
                @if(!empty($bookingRoom))
                    <input type="hidden" name="booking_room_id" value="{{$bookingRoom->id}}">
                    @php
                    $bookingRoomCustomer = $bookingRoom->bookingRoomCustomers()->first();
                    if(!empty($bookingRoom->end_date)) {
                        $endDate = \Carbon\Carbon::parse($bookingRoom->end_date)->format('Y-m-d H:i');
                    } else {
                        $endDate = \Carbon\Carbon::now()->format('Y-m-d H:i');
                    }

                    if(!empty($bookingRoom->start_date)) {
                        $startDate = \Carbon\Carbon::parse($bookingRoom->start_date)->format('Y-m-d H:i');
                    } else {
                        $startDate = \Carbon\Carbon::now()->format('Y-m-d H:i');
                    }
                    $roomIds[] = $bookingRoom->room->id ?? 0;
                    @endphp
                @endif
                @if(!empty($bookingRoomCustomer->customer_id))
                    <input type="hidden" name="customer_id" value="{{$bookingRoomCustomer->customer_id}}">
                @endif
                @if(!empty($bookingRoomCustomer->group_id))
                    <input type="hidden" name="group_id" value="{{$bookingRoomCustomer->group_id}}">
                @endif
                <div class="row mt-3" id="form-booking-multiple">
                    @if(!empty($bookingRoomCustomer->group_id))
                        <div class="col-md-12 mb-3 position-relative">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control form-control-sm validate" id="customer_name" autocomplete="Off"
                                   name="customer_name" required
                                   placeholder="Tên nhóm" value="@if(!empty($bookingRoom) && !empty($bookingRoomCustomer)){{$bookingRoomCustomer->group->name ?? ''}}@endif">
                            <div class="col-md-12 mb-3 list-ajax" id="list-item-customer"></div>
                        </div>
                    @else
                        <div class="col-md-6 mb-3 position-relative">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control form-control-sm validate" id="customer_name" autocomplete="Off"
                                   name="customer_name" required
                                   placeholder="Tên khách hàng" value="@if(!empty($bookingRoom) && !empty($bookingRoomCustomer)){{$bookingRoomCustomer->customer->name ?? ''}}@endif">
                            <div class="col-md-12 mb-3 list-ajax" id="list-item-customer"></div>
                        </div>
                        <div class="col-md-6 mb-3 position-relative">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control form-control-sm validate" id="customer_id_card"
                                   name="customer_id_card" required
                                   placeholder="Số giấy tờ" value="@if(!empty($bookingRoom) && !empty($bookingRoomCustomer)){{$bookingRoomCustomer->customer->id_card ?? ''}}@endif">
                            <div class="col-md-12 mb-3 list-ajax" id="list-item-id_card"></div>
                        </div>

                        <div class="col-md-6 mb-3 position-relative">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control form-control-sm validate" id="customer_phone"
                                   name="customer_phone" required
                                   placeholder="Điện thoại" value="@if(!empty($bookingRoom) && !empty($bookingRoomCustomer)){{$bookingRoomCustomer->customer->phone ?? ''}}@endif">
                            <div class="col-md-12 mb-3 list-ajax" id="list-item-phone"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control form-control-sm validate" id="customer_address"
                                   name="customer_address" required placeholder="Địa chỉ" value="@if(!empty($bookingRoom) && !empty($bookingRoomCustomer)){{$bookingRoomCustomer->customer->address ?? ''}}@endif">
                        </div>
                    @endif


                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label fw-bold">Thời gian bắt
                                    đầu:</label>
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="text" autocomplete="off"  min="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}"  id="start_date" name="start_date"
                                            class="form-control datetime-picker form-control-sm form-control-sm validate-date " readonly
                                            value="@if(!empty($startDate) ){{$startDate ?? ''}}@endif" required>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-md-6 "
                                id="box-end-date">
                                <label for="end_date" class="form-label fw-bold">Thời gian kết
                                    thúc:</label>
                                <div class="input-group date">
                                    <input type="text" autocomplete="off"  min="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}"  id="end_date" name="end_date"
                                        class="form-control datetime-picker form-control-sm form-control-sm validate-date " readonly
                                        value="@if(!empty($endDate) ){{$endDate ?? ''}}@endif" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-bold">Giá thuê mới:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" autocomplete="off"  class="form-control form-control-sm form-control-sm price" name="extra_price" id="extra_price"
                                        value="@if(!empty($bookingRoom)){!! $bookingRoom->extra_price ??0 !!}@endif" min="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">đ</span>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6 ">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="price" class="form-label fw-bold">Ghi chú:</label>
                        <textarea name="note" class="form-control form-control-sm form-control-sm note" cols="30" rows="2"
                                placeholder="Ghi chú">@if(!empty($bookingRoom)) {!! $bookingRoom->note ??'' !!} @endif </textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Danh sách phòng</h5>
                <div class="div-scroll max-height-300 mb-3" id="list-booking-room">
                    @include('room.list-booking-room', ['roomIds' => $roomIds ?? null])
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                Đóng
            </button>

            @if(!empty($bookingRoom))
                <button class="btn btn-sm btn-warning " type="submit">Cập nhật</button>
            @else
                <a href="{{route('booking-room.index')}}" class="btn btn-sm btn-success">Quản lý đặt phòng</a>

                <button class="btn btn-sm btn-primary btn-booking-multiple-room">Đặt phòng</button>
            @endif
        </div>
    </div>
</div>
@if(!empty($bookingRoom))
     </form>
@endif
