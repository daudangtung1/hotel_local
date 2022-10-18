<div class="modal fade" id="booking-modal-{{$room->id}}" aria-labelledby="booking-modalLabel" aria-hidden="true">
    <input type="hidden" name="room_id" value="{{$room->id}}">
    @include('room.modal-content-room')
</div>

<script>
    $('.datetime-picker').datetimepicker({
        todayHighlight: true,
        format: 'Y-m-d H:i',
        startDate: new Date()
    });
</script>