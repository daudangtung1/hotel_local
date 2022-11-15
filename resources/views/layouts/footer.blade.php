@if (\Auth::check())
<footer id="colophon" class="site-footer mt-5" role="contentinfo">
    <div class="container">
        <ul class="list-item">
            <li>
                <p>{{__('Ready')}}: {{\App\Models\Room::where('status', \App\Models\Room::READY)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>{{__('Have_guest')}}: {{\App\Models\Room::where('status', \App\Models\Room::HAVE_GUEST)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>{{__('Guest_out')}}: {{\App\Models\Room::where('status', \App\Models\Room::GUEST_OUTDOOR)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>{{__('Dirty')}}: {{\App\Models\Room::where('status', \App\Models\Room::DIRTY)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>{{__('Cleaning')}}: {{\App\Models\Room::where('status', \App\Models\Room::CLEAN_ROOM)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            <li>
                <p>{{__('Fixing')}}: {{\App\Models\Room::where('status', \App\Models\Room::FIXING_ROOM)->where('branch_id', get_branch_id())->count()}}</p>
            </li>
            @can('Quản lý đặt phòng-create')
            <li>
                <p>
                    <a href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#booking-room">{{__('Booking_room')}}: {{\App\Models\BookingRoom::where('status', \App\Models\Room::BOOKED)->where('branch_id', get_branch_id())->count()}}</a></p>
            </li>
            @endcan
        </ul>
    </div>
</footer><!-- #colophon -->
@endif