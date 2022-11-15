@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="wrap-main">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>{{$title}}</h5>
                </div>
                <div class="col-md-12">
                    <form class="row g-3" method="POST"
                          action="@if(!empty($currentRoom)){{route('rooms.update', ['room'=>$currentRoom])}} @else{{route('rooms.store')}}@endif">
                        @if(!empty($currentRoom))
                            {{method_field('PUT')}}
                        @endif
                        <input type="hidden" name="room_id" value="{{$currentRoom->id ??''}}"/>
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold">{{__('Room_name')}}</label>
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control-sm" id="name" name="name"
                                   value="{{$currentRoom->name ??''}}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="floor" class="form-label fw-bold">{{__('Level')}}</label>
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control-sm" id="floor" name="floor"
                                   value="{{$currentRoom->floor ??''}}" required>
                        </div>

                        <div class="col-md-12">
                            <label for="hour_price" class="form-label fw-bold">{{__('Room_hour')}}</label>
                            <input type="number" min="0" class="form-control form-control-sm form-control-sm" id="hour_price" name="hour_price"
                                   value="{{$currentRoom->hour_price ??'0'}}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="day_price" class="form-label fw-bold">{{__('Room_day')}}</label>
                            <input type="number" min="0" class="form-control form-control-sm form-control-sm" id="day_price" name="day_price"
                                   value="{{$currentRoom->day_price ??'0'}}" required>
                        </div>
                        @if(!empty($currentRoom) && array_key_exists($currentRoom->status, \App\Models\Room::UPDATE_STATUS))
                            <div class="col-md-12">
                                <label for="inputState" class="form-label fw-bold">{{__('Room_status')}}</label>
                                <select id="status" name="status" class="form-select" >
                                    @foreach (\App\Models\Room::UPDATE_STATUS as $key => $item)
                                        <option @if($key == $currentRoom->status) selected  @endif value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="status_desc" class="form-label fw-bold">{{__('Room_status_description')}}</label>
                                <textarea type="text" class="form-control form-control-sm form-control-sm" id="status_desc" name="status_desc">{{$currentRoom->status_desc ??''}}</textarea>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <label for="day_price" class="form-label fw-bold">{{__(''Room_month)}}</label>
                            <input type="number" min="0" class="form-control form-control-sm form-control-sm" id="month_price" name="month_price"
                                   value="{{$currentRoom->month_price ??'0'}}" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary">@if(isset($currentRoom)) {{__('Update')}} @else {{__('Create_room')}} @endif</button>
                            @if(!empty($currentRoom))
                                <a href="{{route('rooms.index')}}" class="btn btn-sm btn-primary">{{__('Create')}}</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
@endsection
