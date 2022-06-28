<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLong" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo mới đồ thất lạc</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select name="booking_room_id" id="booking_room_id" class="form-control booking_room_id mb-3">
                        <option value="">Chọn phòng</option>
                            @forelse($bookingRooms as $key => $bookingRoom)
                                <option value="{{$bookingRoom->id}}">
                                    {{$bookingRoom->room->name ?? ''}} -
                                    {{$bookingRoom->room->floor ?? ''}} -
                                    {{$bookingRoom->start_date ?? ''}} -
                                    {{$bookingRoom->end_date ?? ''}}
                                </option>
                            @empty
                            @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="note" id="note" cols="30" rows="5" class="form-control validate note" placeholder="Ghi chú"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-save">Tạo mới</button>
            </div>
        </div>
    </div>
</div>
<table class="table table-sm table-bordered table-hover">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Tên phòng</th>
        <th scope="col">Tầng</th>
        <th scope="col">Ngày trả</th>
        <th scope="col">Ghi chú</th>
        <th scope="col">Tình trạng</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($lostItems))
        @forelse($lostItems as $key => $lostItem)
            <tr data-lost_item_id="{{$lostItem->id}}">
                <td>{{$lostItem->id}}</td>
                <td>{{$lostItem->bookingRoom->room->name ?? '-'}}</td>
                <td>{{$lostItem->bookingRoom->room->floor ?? '-'}}</td>
                <td  style="width: 200px">{{$lostItem->pay_date ?? '-'}}</td>
                <td>{{$lostItem->note ?? '-'}}</td>
                <td style="width: 120px">
                    <select name="status" id="status" class="form-control status">
                        <option value="0" @if(empty($lostItem->pay_date)) selected @endif>Chưa trả</option>
                        <option value="1" @if(!empty($lostItem->pay_date)) selected @endif>Đã trả</option>
                    </select>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Không có phòng nào</td>
            </tr>
        @endforelse
    @else
        <tr>
            <td colspan="6">Không có phòng nào</td>
        </tr>
    @endif
    </tbody>
</table>
<div class="d-flex justify-content-center mt-2 mb-2">
    {{ $lostItems->links('pagination::bootstrap-4') }}
</div>
