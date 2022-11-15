@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>{{$title ?? ''}}</h5>
                        <div class="filter">
                            <form action="{{route('booking-room-service.report')}}" class="d-flex" method="GET">
                                <input type="text" autocomplete="off"  class="form-control form-control-sm me-2 filter-date" placeholder="{{__('Start_date')}}" name="start_date" value="@if(!empty(request()->start_date)) {{request()->start_date}} @endif"  autocomplete="off">
                                <input type="text" autocomplete="off"  class="form-control form-control-sm me-2 filter-date" placeholder="{{__('End_date')}}" name="end_date" value="@if(!empty(request()->end_date)) {{request()->end_date}} @endif" autocomplete="off">

                                <button class="btn btn-success me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                    </svg>{{__('Filter')}}</button>
                                <button class="btn btn-danger" type="submit" name="export" value="export" >{{__('Export_excel')}}</button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">{{__('Service_name')}}</th>
                            <th scope="col">{{__('Room_name')}}</th>
                            <th scope="col">{{__('Amount')}}</th>
                            <th scope="col">{{__('Unit_price')}}</th>
                            <th scope="col">{{__('Into_money')}}</th>
                            <th scope="col">{{__('Created_date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($bookingRoomServices as $key => $bookingRoomService)
                            <tr>
                                <td>{{ $bookingRoomService->id }}</td>
                                <td>{{ $bookingRoomService->service->name ?? '' }}</td>
                                <td>{{ $bookingRoomService->bookingRoom->room->name ?? __('Not_exist') }}</td>
                                <td>{{ number_format($bookingRoomService->quantity) }}</td>
                                <td>{{ number_format($bookingRoomService->price) }}</td>
                                <td>{{ number_format($bookingRoomService->quantity * $bookingRoomService->price) }}</td>
                                <td>{{ \Carbon\Carbon::parse($bookingRoomService->created_at)->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">{{__('No_data')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-2 mb-2">
                    {{ $bookingRoomServices->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('body').on('change', '#by', function(e){
                $(this).closest('form').submit();
            });
        });
    </script>
@endsection
