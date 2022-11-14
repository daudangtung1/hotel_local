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
                            <th>{{__('Customer_name')}}:</th>
                            <td>{{$bookingRoomInfo->cusomter_name}}</td>
                        </tr>
                        <tr>
                            <th>{{__('ID_card_2')}}:</th>
                            <td>{{$bookingRoomInfo->id_card}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Phone')}}:</th>
                            <td>{{$bookingRoomInfo->phone}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Address')}}:</th>
                            <td>{{$bookingRoomInfo->address}}</td>
                        </tr>
                        <tr>
                            <th>{{__('ID_card_2')}}:</th>
                            <td>{{$bookingRoomInfo->id_card}}</td>
                        </tr>
                        <tr>
                            <th>{{__('ID_card_2')}}:</th>
                            <td>{{$bookingRoomInfo->id_card}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Time_start')}}:</th>
                            <td>{{$bookingRoomInfo->start_date ?? \Carbon\Carbon::now()}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Time_end')}}:</th>
                            <td>{{$bookingRoomInfo->end_date ?? \Carbon\Carbon::now()}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Note')}}:</th>
                            <td>@if(!empty($bookingRoomInfo)) {!! $bookingRoomInfo->note ??'' !!} @endif </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h5>{{__('Room_information')}}</h5>
                <div class="max-height-300 mb-3" id="list-booking-room">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">{{__('Room_name')}}</th>
                                <th scope="col">{{__('Level')}}</th>
                                <th scope="col">{{__('Hourly_price')}}</th>
                                <th scope="col">{{__('Daily_price')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$bookingRoomInfo->id}}</td>
                                <td>{{$bookingRoomInfo->room_name ?? __('Deleted')}}</td>
                                <td>{{$bookingRoomInfo->floor ?? __('Deleted')}}</td>
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
                {{__('Close')}}
            </button>
            <form method="get" action="{{route('customers.booking_info')}}">
                <input type="hidden" name="room_id" value="{{$bookingRoomInfo->room_id}}" />
                <button type="submit" class="btn btn-sm btn-primary">
                    {{__('List')}}
                </button>
            </form>
            <button data-booking_room_id="{{$bookingRoomInfo->id}}" data-bg="primary" type="submit" class="btn btn-sm btn-primary  btn-checkin ">{{__('Get_room')}}</button>
        </div>
    </div>
</div>