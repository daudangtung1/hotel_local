<table class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">{{__('ID')}}</th>
            <th scope="col">{{__('Debit_name')}}</th>
            <th scope="col">{{__('Booking_room')}}</th>
            <th scope="col">{{__('Debit_number')}}</th>
            <th scope="col">{{__('Status')}}</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($items))
        @forelse($items as $key => $item)
        <tr data-item_id="{{$item->id}}">
            <td>{{$item->id}}</td>
            <td>{!!$item->name ?? '-'!!}</td>
            <td>
                <p><b>{{__('Room')}}</b> {!! $item->bookingRoom->room->name ?? __('Not_exist') !!}</p>
                <p><b>{{__('Level')}}:</b> {{$item->bookingRoom->room->floor ?? __('Not_exist')}}</p>
                <p><b>{{__('Check_in')}}: </b>{{$item->bookingRoom->start_date ?? __('Not_exist')}}</p>
                <p><b>{{__('Check_out')}}: </b>{{$item->bookingRoom->end_date ?? __('Not_exist')}}</p>
            </td>
            <td>{{get_price($item->price ?? 0, 'đ')}}</td>
            <td>
                @if(empty($item->status))
                    <select name="status" id="status" class="form-control form-control-sm status">
                        <option value="0">{{__('Unpaid')}}</option>
                        <option value="1">{{__('Paid')}}</option>
                    </select>
                @else
                    <b class="text-success">{{__(\App\Models\Debt::ARRAY_STATUS[$item->status])}}</b> <br />
                    @if ($item->status == 1)
                    <b>{{__('Date_payment')}}: {{$item->updated_at}}</b>
                    @endif
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">{{__('No_data')}}</td>
        </tr>
        @endforelse
        @else
        <tr>
            <td colspan="5">{{__('No_data')}}</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-center mt-2 mb-2">
    {{ $items->links('pagination::bootstrap-4') }}
</div>
