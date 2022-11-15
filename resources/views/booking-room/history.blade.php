@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>{{__('Reservation_management')}}</h5>
                        <a href="{{route('booking-room.index')}}" class="btn btn-light">{{__('Back')}}</a>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">{{__('Room_name')}}</th>
                            <th scope="col">{{__('Level')}}</th>
                            <th scope="col">{{__('Check_in_date')}}</th>
                            <th scope="col">{{__('Check_in_date')}}</th>
                            <th scope="col">{{__('Customer_name')}}</th>
                            <th scope="col">{{__('Note')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($bookingRooms))
                            @forelse($bookingRooms as $key => $bookingRoom)
                                <tr>
                                    <td>{{$bookingRoom->id ??''}}</td>
                                    <td>{{$bookingRoom->room->name ?? __('Not_exist')}}</td>
                                    <td>{{$bookingRoom->room->floor ?? __('Not_exist')}}</td>
                                    <td>{{$bookingRoom->start_date ?? ''}}</td>
                                    <td>{{$bookingRoom->end_date ?? ''}}</td>
                                    <td>
                                        @foreach($bookingRoom->bookingRoomCustomers()->get() as $customer)
                                            <p>{{$customer->customer->name ?? __('Not_exist')}}</p>
                                        @endforeach
                                    </td>
                                    <td>{{$bookingRoom->note ?? ''}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">{{__('No_data')}}</td>
                                </tr>
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        {{ $bookingRooms->links('pagination::bootstrap-4') }}
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('body').on('click', '.btn-ajax-delete', function (e) {
                                e.preventDefault();
                                if (!confirm("{{__('Confirm_delete')}}")) {
                                    return false;
                                }

                                $(this).closest('form').submit();
                            })
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
