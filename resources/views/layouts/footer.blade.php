@if (\Auth::check())
<footer id="colophon" class="site-footer mt-5" role="contentinfo">
    <div class="container">
        <ul class="list-item">
            <li>
                <p>Sẵn sàng: {{\App\Models\Room::where('status', \App\Models\Room::READY)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>Có khách: {{\App\Models\Room::where('status', \App\Models\Room::HAVE_GUEST)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>Khách ra ngoài: {{\App\Models\Room::where('status', \App\Models\Room::GUEST_OUTDOOR)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>Bẩn: {{\App\Models\Room::where('status', \App\Models\Room::DIRTY)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>Đang dọn: {{\App\Models\Room::where('status', \App\Models\Room::CLEAN_ROOM)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>Đang sửa: {{\App\Models\Room::where('status', \App\Models\Room::FIXING_ROOM)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            @can('Quản lý đặt phòng-create')
            <li>
                <p>
                    <a href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#booking-room">Đặt
                        phòng:{{\App\Models\BookingRoom::where('status', \App\Models\Room::BOOKED)->where('branch_id', get_branch_id())->count()}}</a></p>
            </li>
            @endcan
        </ul>
    </div>
</footer><!-- #colophon -->
@endif