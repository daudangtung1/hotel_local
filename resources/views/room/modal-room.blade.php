<div class="modal fade" id="booking-modal-{{$room->id}}"
     aria-labelledby="booking-modalLabel" aria-hidden="true">
    <input type="hidden" name="room_id" value="">
    @include('room.modal-content-room')
</div>
