<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" class="booking-modalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        <div class="modal-body row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <label for="name" class="form-label">Tên Khách hàng:</label>
                    <input type="text" class="form-control" id="customer_name"
                           name="customer_name" required
                           placeholder="Tên khách hàng">
                </div>
                <div class="col-md-12">
                    <label for="idCard" class="form-label">Số giấy tờ:</label>
                    <input type="text" class="form-control" id="customer_id_card"
                           name="customer_id_card" required
                           placeholder="Số giấy tờ">
                </div>

                <div class="col-md-12">
                    <label for="phone" class="form-label">Điện thoại:</label>
                    <input type="text" class="form-control" id="customer_phone"
                           name="customer_phone" required
                           placeholder="Điện thoại">
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label">Địa chỉ:</label>
                    <input type="text" class="form-control" id="customer_address"
                           name="customer_address" required placeholder="Địa chỉ">
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="start_date" class="form-label">Thời gian bắt
                                đầu:</label>
                            <div class="form-group">
                                <div class="input-group date">
                                    <input type="text" id="start_date"
                                           class="form-control datetime-picker"
                                           readonly
                                           value="{{\Carbon\Carbon::now()}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="end_date" class="form-label">Thời gian kết
                                thúc:</label>
                            <div class="input-group date">
                                <input type="text" id="end_date"
                                       class="form-control datetime-picker" readonly
                                       value="{{\Carbon\Carbon::now()}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-success btn-add-customer">Thêm khách hàng</button>
                </div>
            </div>
            <div class="col-md-5">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Tên dịch vụ</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng tiền</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($room->bookingRooms()->first())
                        @forelse($room->bookingRooms()->first()->bookingRoomServices()->get() as $key => $bookingRoomService)
                            <tr>
                                <td>{{$bookingRoomService->service->name ??''}}</td>
                                <td>{{$bookingRoomService->quantity ?? ''}}</td>
                                <td>{{get_price(($bookingRoomService->service->price ?? 0) * ($bookingRoomService->quantity ?? 0), 'VNĐ') ??''}}</td>
                                <td><a href="{{route('booking-room-service.destroy',['booking_room_service' => $bookingRoomService])}}" class="btn-remove-service" data-booking_room_service_id="{{$bookingRoomService->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="16" height="16" fill="currentColor"
                                             class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Không có dịch vụ nào</td>
                            </tr>
                        @endforelse
                    @endif
                    </tbody>
                </table>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Tên khách hàng̣</th>
                        <th scope="col">Số giấy tờ</th>
                        <th scope="col">Điện thoại</th>
                        <th>Địa chỉ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($room->bookingRooms()->first())
                        @forelse($room->bookingRooms()->orderBy('id','DESC')->first()->bookingRoomCustomers()->get() as $key => $bookingRoom)
                            <tr>
                                <td>{{$bookingRoom->Customer->name ??''}}</td>
                                <td>{{$bookingRoom->Customer->id_card ??''}}</td>
                                <td>{{$bookingRoom->Customer->phone ??''}}</td>
                                <td>{{$bookingRoom->Customer->address ??''}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Không có khách hàng nào</td>
                            </tr>
                        @endforelse
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Tên dịch vụ</th>
                        <th scope="col">Tồn kho</th>
                        <th scope="col">Giá</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($services as $key => $service)
                        <tr>
                            <td>{{$service->name ??''}}</td>
                            <td>{{$service->stock ??''}}</td>
                            <td>{{get_price($service->price, 'VNĐ') ??''}}</td>
                            <td><a href="" class="btn-add-service" data-service_id="{{$service->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="16" height="16" fill="currentColor"
                                         class="bi bi-plus-circle"
                                         viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Không có khách hàng nào</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Đóng
            </button>
            <button type="submit" class="btn btn-primary save-booking-room">{{$room->getTextButton()}}</button>
        </div>
    </div>
</div>
