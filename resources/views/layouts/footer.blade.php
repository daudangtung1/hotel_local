<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
        <ul class="list-item">
            <li>
                <p>Sẵn sàng: {{\App\Models\Room::where('status', 0)->count()}}</p>
            </li>
            <li>
                <p>Có khách: {{\App\Models\Room::where('status', 1)->count()}}</p>
            </li>
            <li>
                <p>Khách ra ngoài: 0</p>
            </li>
            <li>
                <p>Bẩn: {{\App\Models\Room::where('status', 2)->count()}}</p>
            </li>
            <li>
                <p>Đang dọn: 0</p>
            </li>
            <li>
                <p>Đang sửa: 0</p>
            </li>
            <li>
                <p><a href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#booking-room">Đặt phòng:{{\App\Models\BookingRoom::where('status', 6)->count()}}</a></p>
            </li>
        </ul>
    </div>
</footer><!-- #colophon -->

<div class="modal fade" id="booking-room"
     aria-labelledby="booking-modalLabel" aria-hidden="true">
    @include('room.model-booking-room')
</div>

<script>
    $(document).ready(function(){
        $('body').on('click', '.btn-booking-multiple-room', function(){
            var _this = $(this);
            var modal = _this.closest('.modal');
            var customerName = modal.find('#customer_name').val();
            var customerIdCard = modal.find('#customer_id_card').val();
            var customerPhone = modal.find('#customer_phone').val();
            var customerAddress = modal.find('#customer_address').val();
            var startDate = modal.find('#start_date').val();
            var endDate = modal.find('#end_date').val();
            var note = modal.find('.note').val();

            var roomIds = [];
            $('input[name="room_ids[]"]:checked').map(function() {
                roomIds.push($(this).val());
            });
            if(roomIds == '') {
                $.toast({
                    text: 'Vui lòng chọn phòng cần đặt.',
                    icon: 'error',
                    position: 'top-right'
                });
                return false;
            }
            if (startDate >= endDate) {
                $.toast({
                    text: 'Vui lòng nhập kết thúc lớn hơn ngày bắt đầu',
                    icon: 'error',
                    position: 'top-right'
                });
                return false;
            }

            if (customerName == '' || customerIdCard == '' || customerPhone == '' || customerAddress == '' || startDate == '' || endDate == '' ) {
                $.toast({
                    text: 'Vui lòng nhập thông tin khách hàng',
                    icon: 'error',
                    position: 'top-right'
                });
                return false;
            }

            $.ajax({
                type: "post",
                url: "{{route('booking-room.booking_rooms')}}",
                data: {
                    room_ids: roomIds,
                    customer_name: customerName,
                    customer_id_card: customerIdCard,
                    customer_phone: customerPhone,
                    customer_address: customerAddress,
                    start_date: startDate,
                    end_date: endDate,
                    note: note,
                },
                success: function (data) {
                    if (typeof data.response !== 'undefined') {
                        $.toast({
                            text: data.response.message,
                            icon: 'error',
                            position: 'top-right'
                        });
                        return false;
                    }
                    modal.find('.modal-dialog').html(data);
                    $.toast({
                        text: 'Cập nhật thành công',
                        icon: 'success',
                        position: 'top-right'
                    });
                    refreshView();
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }) ;
    });
</script>
