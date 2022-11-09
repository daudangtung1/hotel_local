@php
$bookingRoom = $room->bookingRooms()->where('branch_id', get_branch_id())->whereIn('status', [1,3,5])->where('status', '<>', 7)->first();
    @endphp
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" class="booking-modalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row " id="form-booking">
                <div class="col-md-6">
                    @if(!empty($bookingRoom))
                    <h2>Khách hàng thuê phòng</h2>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Tên khách hàng̣</th>
                                <th scope="col">Số giấy tờ</th>
                                <th scope="col">Điện thoại</th>
                                <th>Địa chỉ</th>
                                @if($bookingRoom->bookingRoomCustomers()->count() > 1)
                                <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookingRoom->bookingRoomCustomers()->get() as $key => $bookingRoomCustomer)
                            <tr>
                                <td>{{$bookingRoomCustomer->customer->name ??'Không tồn tại'}}</td>
                                <td>{{$bookingRoomCustomer->customer->id_card ??'Không tồn tại'}}</td>
                                <td>{{$bookingRoomCustomer->customer->phone ??'Không tồn tại'}}</td>
                                <td>{{$bookingRoomCustomer->customer->address ??'Không tồn tại'}}</td>
                                @if($bookingRoom->bookingRoomCustomers()->count() > 1)
                                <td>
                                    <a href="{{route('booking-room-customers.destroy', ['booking_room_customer' => $bookingRoomCustomer])}}" class="btn-ajax-delete-customer text-danger  btn-sm ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Không có dữ liệu</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <hr>
                    @endif
                    <h2>Khách hàng</h2>
                    <div id="customer-booking" class="form-user">
                        <div class="col-md-12 mb-3 position-relative">
                            <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm validate " id="customer_name" name="customer_name" required placeholder="Tên khách hàng" autocomplete="Off">
                            <div class="col-md-12 mb-3 list-ajax" id="list-item-customer"></div>
                        </div>
                        <div class="col-md-12 mb-3 position-relative">
                            <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm validate " id="customer_id_card" name="customer_id_card" required placeholder="Số giấy tờ" autocomplete="Off">
                            <div class="col-md-12 mb-3 list-ajax" id="list-item-id_card"></div>
                        </div>

                        <div class="col-md-12 mb-3 position-relative">
                            <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm validate " id="customer_phone" name="customer_phone" required placeholder="Điện thoại" autocomplete="Off">
                            <div class="col-md-12 mb-3 list-ajax" id="list-item-phone"></div>
                        </div>
                        <div class="col-md-12 mb-3 position-relative">
                            <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm validate " id="customer_address" name="customer_address" required placeholder="Địa chỉ">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label fw-bold">Thời gian bắt
                                        đầu:</label>
                                    <div class="form-group">
                                        <div class="input-group date">
                                            <span class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                    <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                </svg>
                                            </span>
                                            <input type="text" autocomplete="off" min="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}" id="start_date" class="form-control form-control-sm form-control-sm datetime-picker" readonly value="@if(!empty($bookingRoom) && !empty($bookingRoom->start_date)){{date('Y-m-d H:i',strtotime( $bookingRoom->start_date))}}@else{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}@endif" min="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 @if(empty($bookingRoom) || empty($bookingRoom->end_date) ) d-none @endif" id="box-end-date">
                                    <label for="end_date" class="form-label fw-bold">Thời gian kết
                                        thúc:</label>
                                    <div class="input-group date">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                            </svg>
                                        </span>
                                        <input type="text" autocomplete="off" min="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}" id="end_date" class="form-control form-control-sm form-control-sm datetime-picker" readonly value="@if(!empty($bookingRoom) && !empty($bookingRoom->end_date) && $bookingRoom->rent_type == 1){{date('Y-m-d H:i',strtotime( $bookingRoom->end_datedate))}}@else{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}@endif">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty($bookingRoom))
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-sm btn-primary btn-add-customer">Thêm khách hàng</button>
                    </div>
                    @endif
                </div>
                <div class="col-md-6">
                    @if($bookingRoom)
                    <input type="hidden" name="booking_room_id" value="{{$bookingRoom->id}}">
                    @if($bookingRoom->bookingRoomServices()->count() > 0)
                    <h2>Dịch vụ đang sử dụng</h2>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Tên dịch vụ</th>
                                <th scope="col">Số lượng/ngày thuê</th>
                                <th scope="col">Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookingRoom->bookingRoomServices()->get() as $key => $bookingRoomService)
                            <tr>
                                <td>{{$key++}}</td>
                                <td>
                                    {{$bookingRoomService->service->name ??'Không tồn tại'}}
                                </td>
                                <td>
                                    @if($bookingRoomService->start_date)
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="me-5 d-inline-block"><b>Tổng:</b> {{$bookingRoomService->getTotalDate(true)}}</span>
                                        </div>
                                        <div class="col-12 d-flex">
                                            <div class="input-group date">
                                                <span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                        <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                    </svg>
                                                </span>
                                                <input type="text" autocomplete="off" value="{{\Carbon\Carbon::parse($bookingRoomService->start_date)->format('Y-m-d H:i')}}" readonly class="me-2 datetime-picker form-control form-control-sm modal_start_date" name="modal_start_date">
                                            </div>
                                            <div class="input-group date">
                                                <span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                                        <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                    </svg>
                                                </span>
                                                <input type="text" autocomplete="off" value="{{\Carbon\Carbon::parse($bookingRoomService->end_date)->format('Y-m-d H:i')}}" readonly class="me-2 datetime-picker form-control form-control-sm modal_end_date" name="modal_end_date">
                                            </div>
                                            <button class="btn btn-sm btn-success model-btn-update-service" data-url_update="{{route('booking-room-service.update', ['booking_room_service' => $bookingRoomService])}}" data_service-id="{{$bookingRoomService->id}}">Cập nhật</button>
                                        </div>
                                    </div>
                                    @else
                                    <input data-url_update="{{route('booking-room-service.update', ['booking_room_service' => $bookingRoomService])}}" type="text" class="form-control form-control-sm form-control form-control-sm quantity_service" name="quantity_service" id="quantity_service" value="@if(!empty($bookingRoomService)){!! $bookingRoomService->quantity ??0 !!}@endif" min="0">
                                    @endif
                                </td>
                                <td>
                                    @if($bookingRoomService->start_date)
                                    {{get_price(($bookingRoomService->price ?? 0) * $bookingRoomService->getTotalDate(), 'đ') ??''}}
                                    @else
                                    {{get_price(($bookingRoomService->price ?? 0) * ($bookingRoomService->quantity ?? 0), 'đ') ??''}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('booking-room-service.destroy',['booking_room_service' => $bookingRoomService])}}" class="btn-remove-service" data-booking_room_service_id="{{$bookingRoomService->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Không có dịch vụ nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @endif
                    <hr>
                    @endif

                    <h2>Dịch vụ</h2>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Tên dịch vụ</th>
                                <th scope="col">Tồn kho</th>
                                <th scope="col">Giá</th>
                                @if($bookingRoom)
                                <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $key => $service)
                            <tr>
                                <td>{{$service->id}}</td>
                                <td>{{$service->name ??''}}
                                    @if($service->sale_type == 0)
                                    <div class="row d-none">
                                        <div class="col-12 d-flex">
                                            <input type="text" autocomplete="off" value="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}" min="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}" readonly class="datetime-picker form-control form-control-sm modal_start_date me-2" name="modal_start_date">
                                            <input type="text" autocomplete="off" value="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}" min="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}" readonly class="datetime-picker form-control form-control-sm modal_end_date me-2" name="modal_end_date">
                                            <button class="btn btn-sm btn-primary model-btn-add-service">Thêm</button>
                                        </div>
                                        <input type="hidden" name="modal_service_id" class="modal_service_id" value="{{$service->id}}">
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if($service->sale_type == 0)
                                    <b class="whitespace-nowrap">Thuê theo ngày</b>
                                    @else
                                    {{$service->stock ??''}}
                                    @endif
                                </td>
                                <td>{{get_price($service->price, 'đ') ??''}}</td>
                                @if($bookingRoom)
                                <td><a href="" class="btn-add-service" data-service_id="{{$service->id}}" data-sale_type={{$service->sale_type}}>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </a></td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Không có dữ liệu</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if(empty($bookingRoom))
                    <div class="col-md-12 mt-3">
                        <div class="form-check">
                            <input class="form-check-input rentType" type="radio" name="rent_type" id="exampleRadios2{{$room->id}}" value="0" @if($bookingRoom && $bookingRoom->rent_type == 0) checked @endif >
                            <label class="form-check-label" for="exampleRadios2{{$room->id}}">
                                Thuê theo giờ ({{get_price($room->hour_price ?? 0, 'đ')}}/giờ)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input rentType" type="radio" name="rent_type" id="exampleRadios1{{$room->id}}" value="1" @if($bookingRoom && $bookingRoom->rent_type == 1) checked @endif>
                            <label class="form-check-label" for="exampleRadios1{{$room->id}}">
                                Thuê theo ngày ({{get_price($room->day_price ?? 0, 'đ') }}/ngày)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input rentType" type="radio" name="rent_type" id="exampleRadios3{{$room->id}}" value="2" @if($bookingRoom && $bookingRoom->rent_type == 2) checked @endif>
                            <label class="form-check-label" for="exampleRadios3{{$room->id}}">
                                Thuê theo tháng ({{get_price($room->month_price ?? 0, 'đ') }}/tháng)
                            </label>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12 mt-3">
                        <label for="price" class="form-label fw-bold">Giá thuê mới:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm price" name="price" id="price" value="@if(!empty($bookingRoom)){!! $bookingRoom->price ??0 !!}@endif" min="0">
                            <div class="input-group-append">
                                <span class="input-group-text">đ</span>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-12 extra-price-box  @if(!empty($bookingRoom) && !empty($bookingRoom->end_date)) d-block @else d-none @endif" id="box-extra-price">
                        <label for="extra_price" class="form-label fw-bold">Số tiền quá giờ̀:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm extra_price" name="extra_price" id="extra_price" value="@if(!empty($bookingRoom)){!! $bookingRoom->extra_price ?? 0 !!}@endif" min="0">
                            <div class="input-group-append">
                                <span class="input-group-text">đ</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="price" class="form-label fw-bold">Ghi chú:</label>
                        <textarea name="note" class="form-control form-control-sm form-control-sm note" cols="30" rows="2" placeholder="Ghi chú">@if(!empty($bookingRoom)) {!! $bookingRoom->note ??'' !!} @endif </textarea>
                    </div>
                    @if(!empty($bookingRoom) && in_array($bookingRoom->status, [1,3,5]))
                    <div class="col-md-12 mt-3">
                        <label for="price" class="form-label fw-bold">Tình trạng:</label>
                        <select name="booking_room_status" id="booking_room_status" class="form-control form-control-sm">
                            <option value="" selected>Không</option>
                            @foreach(\App\Models\Room::ARRAY_UPDATE_STATUS as $key => $status)
                            <option @if($bookingRoom->status == $key) selected
                                @endif value="{{$key}}">{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    Đóng
                </button>
                @if(!empty($bookingRoom))
                <button type="button" class="btn btn-sm btn-default btn-success btn-update btn-warning" data-booking_room_id="{{$bookingRoom->id}}">
                    Cập nhật
                </button>
                @endif
                @php
                $bookingRoomCleaning = $room->bookingRooms()->where('status', 2)->first();
                @endphp
                @if(!empty($bookingRoomCleaning ))
                <a href="{{route('booking-room.show_invoice',['id' => $bookingRoomCleaning->id])}}" target="_blank" class="btn btn-sm btn-default btn-success">
                    Xem hóa đơn
                </a>
                @endif
                @if($room->status == \App\Models\Room::HAVE_GUEST)
                <a id="modal_check_btn_{{$room->id}}" href="#modal_check_form_{{$room->id}}" data-bg="{{$room->getBgButton()}}" class="btn btn-sm btn-{{$room->getBgButtonSubmit()}} " data-toggle="modal">{{$room->getTextButton()}}</a>
                @else
                <button data-bg="{{$room->getBgButton()}}" type="submit" @if($room->status != \App\Models\Room::READY || $room->status != \App\Models\Room::HAVE_GUEST) data-action="{{route('room.change-status', ['room_id' => $room->id])}}"
                    @endif class="btn btn-sm btn-{{$room->getBgButtonSubmit()}} @if($room->status == \App\Models\Room::READY) btn-booking-room @else btn-change-status @endif" >{{$room->getTextButton()}}</button>
                @endif
            </div>
        </div>
    </div>
