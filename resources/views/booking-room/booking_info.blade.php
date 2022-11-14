@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>{{$title}}</h5>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">{{__('Customer_name')}}</th>
                            <th scope="col">{{__('Phone')}}</th>
                            <th scope="col">{{__('Information')}}</th>
                            <th scope="col">{{__('Address')}}</th>
                            <th scope="col">{{__('Room')}}</th>
                            <th scope="col">{{__('Start_date')}}</th>
                            <th scope="col">{{__('End_date')}}</th>
                            <th scope="col">{{__('Note')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($customerInfoBookingRooms))
                            @forelse($customerInfoBookingRooms as $key => $customer)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$customer->cusomter_name}}</td>
                                    <td>{{$customer->phone ??''}}</td>
                                    <td>{{$customer->id_card ??''}}</td>
                                    <td>{{$customer->address ??''}}</td>
                                    <td>{{$customer->name ?? ''}}</td>
                                    <td>{{$customer->start_date ?? ''}}</td>
                                    <td>{{$customer->end_date ?? ''}}</td>
                                    <td>{{$customer->note ?? ''}}</td>
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
                        {{ $customerInfoBookingRooms->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
