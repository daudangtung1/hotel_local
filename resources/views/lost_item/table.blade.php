<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLong"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Create_lost_item')}}</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select name="booking_room_id" id="booking_room_id" class="form-control form-control-sm booking_room_id mb-3" required>
                        <option value="">{{__('Select_room')}}</option>
                        @forelse($bookingRooms as $key => $bookingRoom)
                            <option value="{{$bookingRoom->id}}">
                                {{$bookingRoom->room->name ?? __('Not_exist')}} -
                                {{$bookingRoom->room->floor ?? __('Not_exist')}} -
                                {{$bookingRoom->start_date ?? ''}} -
                                {{$bookingRoom->end_date ?? ''}}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="note" id="note" cols="30" rows="5" class="form-control form-control-sm validate note" required
                              placeholder="{{__('Note')}}"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-save">{{__('Create')}}</button>
            </div>
        </div>
    </div>
</div>
<table class="table table-sm table-bordered table-hover">
    <thead>
    <tr>
        <th scope="col">{{__('ID')}}</th>
        <th scope="col">{{__('Room_name')}}</th>
        <th scope="col">{{__('Level')}}</th>
        <th scope="col">{{__('Pay_day')}}</th>
        <th scope="col">{{__('Note')}}</th>
        <th scope="col">{{__('Status')}}</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($lostItems))
        @forelse($lostItems as $key => $lostItem)
            <tr data-lost_item_id="{{$lostItem->id}}">
                <td>{{$lostItem->id}}</td>
                <td>{{$lostItem->bookingRoom->room->name ?? __('Not_exist')}}</td>
                <td>{{$lostItem->bookingRoom->room->floor ?? __('Not_exist')}}</td>
                <td style="width: 200px">{{$lostItem->pay_date ?? '-'}}</td>
                <td>
                    <textarea name="note" class="form-control form-control-sm note" cols="30"
                              rows="2">{{$lostItem->note ?? '-'}}</textarea>
                </td>
                <td style="width: 120px">
                    @if(empty($lostItem->pay_date))
                        <select name="status" id="status" class="form-control form-control-sm status">
                            <option value="0" @if(empty($lostItem->pay_date)) selected @endif>{{__('Unpaid')}}</option>
                            <option value="1" @if(!empty($lostItem->pay_date)) selected @endif>{{__('Paid')}}</option>
                        </select>
                    @else
                        <span class="text-success">{{__('Paid')}}</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{__('No_data')}}</td>
            </tr>
        @endforelse
    @else
        <tr>
            <td colspan="6">{{__('No_data')}}</td>
        </tr>
    @endif
    </tbody>
</table>
<div class="d-flex justify-content-center mt-2 mb-2">
    {{ $lostItems->links('pagination::bootstrap-4') }}
</div>
