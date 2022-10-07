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
            <li>
                <p>
                    <span class="d-inline-block" style="margin-right: 5px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                             class="bi bi-alarm" viewBox="0 0 16 16">
                        <path
                            d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"></path>
                        <path
                            d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"></path>
                    </svg>
                    </span>
                    <a href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#booking-room">Đặt
                        phòng:{{\App\Models\BookingRoom::where('status', \App\Models\Room::BOOKED)->where('branch_id', get_branch_id())->count()}}</a></p>
            </li>
        </ul>
    </div>
</footer><!-- #colophon -->
@endif