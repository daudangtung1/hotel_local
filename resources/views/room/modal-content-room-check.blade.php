    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-12 mt-3">
                    <label for="price" class="form-label fw-bold">Tiền nhận:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm price" name="money_received" value="" min="0">
                        <div class="input-group-append">
                            <span class="input-group-text">đ</span>
                        </div>
                    </div>
                    <label for="price" class="form-label fw-bold">Tiền nợ:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm price" name="money_unpaid" value="" min="0">
                        <div class="input-group-append">
                            <span class="input-group-text">đ</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-bg="{{$room->getBgButton()}}" type="button" @if($room->status != \App\Models\Room::READY) data-action="{{route('room.change-status', ['room_id' => $room->id])}}"
                    @endif class="btn btn-sm btn-{{$room->getBgButtonSubmit()}} @if($room->status == \App\Models\Room::READY) btn-booking-room @else btn-change-status @endif" >{{$room->getTextButton()}}
                </button>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    Đóng
                </button>
            </div>
        </div>
    </div>