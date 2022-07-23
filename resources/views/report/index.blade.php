@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row d-flex justify-content-between mb-3">
                <div class="col-md-4">
                    <h5>{{$title ?? ''}} @if(isset(request()->by))[{{\App\Models\Room::Filter[request()->by]}}]@endif</h5>
                </div>
                <div class="col-md-2">
                    <form action="" class="d-flex" method="GET">
                        <select class="form-control me-2" name="by" id="by">
                            @foreach(\App\Models\Room::Filter as $key => $filter)
                                <option @if(!empty(request()->by) && request()->by == $key) selected
                                        @endif value="{{$key}}">{{$filter}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            <div class="row">
                @if(request()->get('by') == \App\Models\Room::FILTER_BY_ROOM)
                    @include('report.form-booking-room')
                @elseif(request()->get('by') == \App\Models\Room::FILTER_BY_RAE)
                    @include('report.form-revenue-expenditure')
                @elseif(request()->get('by') == \App\Models\Room::FILTER_BY_STATUS_ROOM)
                    @include('report.form-status-room')
                @elseif(request()->get('by') == \App\Models\Room::FILTER_BY_STATUS_ROOM_EMPTY)
                    @include('report.form-status-room-empty')
                @else
                @endif
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

            var date = $('.filter-date');
            if (date) {
                date.datetimepicker({
                    todayHighlight: true,
                    format: 'Y-m-d',
                    startDate: new Date()
                });
            }
        });
    </script>
@endsection
