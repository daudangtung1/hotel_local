@if($room->status == \App\Models\Room::HAVE_GUEST)
<div class="modal fade modal_child" id="modal_check_form_{{$room->id}}" aria-labelledby="booking-modalLabel" aria-hidden="true">
    @include('room.modal-content-room-check')
</div>
@endif
<div class="modal fade modal_parent" id="booking-modal-{{$room->id}}" aria-labelledby="booking-modalLabel" aria-hidden="true">
    <input type="hidden" name="room_id" value="{{$room->id}}">
    @include('room.modal-content-room')
</div>
<script>
    $('.datetime-picker').datetimepicker({
        todayHighlight: true,
        format: 'Y-m-d H:i',
        startDate: new Date()
    });

    $('body').on('click', '#modal_check_btn_{{$room->id}}', function() {
        $(this).parents('#poup-booking-room').find('.modal_parent').modal('hide');
        $(this).parents('#poup-booking-room').find('.modal_child').modal('show');
    });
</script>