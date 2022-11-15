@extends('layouts.app')
@section('content')
<div class="wrap-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5>{{__('Room_type_management')}}</h5>
            </div>
            @can('Quản lý loại phòng-create')
            <div class="col">
                <form class="row g-3" method="POST" action="@if(!empty($currentTypeRoom)){{route('type-rooms.update', ['type_room'=>$currentTypeRoom])}} @else{{route('type-rooms.store')}}@endif">
                    @if(!empty($currentTypeRoom))
                    {{method_field('PUT')}}
                    @endif
                    <input type="hidden" name="type_room_id" value="{{$currentTypeRoom->id ??''}}" />
                    @csrf
                    <div class="col-md-12">
                        <label for="name" class="form-label fw-bold">{{__('Room_type')}}</label>
                        <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm" id="name" name="name" value="{{$currentTypeRoom->name ??''}}" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-sm  @if(isset($currentTypeRoom)) btn-success @else btn-primary  @endif">@if(isset($currentTypeRoom)) {{__('Update')}} @else{{__('Create')}} @endif</button>
                    </div>
                </form>
            </div>
            @endcan
            @can('Quản lý loại phòng-list')
            <div class="col">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{__('Room_type')}}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($typeRooms as $key => $typeRoom)
                        <tr>
                            <td>{{$typeRoom->name ??''}}</td>
                            <td style="width:40px">
                                <div class="d-flex">
                                    @can('Quản lý loại phòng-update')
                                    <a class=" text-warning mr-2 d-inline-block" style="margin-right: 5px;" href="{{route('type-rooms.edit',['type_room' => $typeRoom])}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                        </svg>
                                    </a>
                                    @endcan
                                    @can('Quản lý loại phòng-delete')
                                    <form action="{{route('type-rooms.destroy',['type_room' => $typeRoom])}}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <a href="" class="btn-ajax-delete text-danger  btn-sm ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V4.059L11.882 4H5.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </a>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">{{__('No_data')}}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-2 mb-2">
                    {{ $typeRooms->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endcan
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h5>{{__('Room_management_f')}}</h5>
            </div>
            @can('Quản lý phòng-create')
            <div class="col">
                <form class="row g-3" method="POST" action="@if(!empty($currentRoom)){{route('rooms.update', ['room'=>$currentRoom])}} @else{{route('rooms.store')}}@endif">
                    @if(!empty($currentRoom))
                    {{method_field('PUT')}}
                    @endif
                    <input type="hidden" name="room_id" value="{{$currentRoom->id ??''}}" />
                    @csrf
                    <div class="col-md-12">
                        <label for="name" class="form-label fw-bold">{{__('Room_name')}}</label>
                        <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm" id="name" name="name" value="{{$currentRoom->name ??''}}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="floor" class="form-label fw-bold">{{__('Level')}}</label>
                        <input type="text" autocomplete="off" class="form-control form-control-sm form-control-sm" id="floor" name="floor" value="{{$currentRoom->floor ??''}}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="inputState" class="form-label fw-bold">{{__('Room_type')}}</label>
                        <select id="type" name="type" class="form-select" required>
                            @forelse($typeRoomsSelect as $key => $typeRoom)
                            <option @if(!empty($typeRoom) && !empty($currentRoom) && $typeRoom->id == $currentRoom->type_room_id) selected @endif value="{{$typeRoom->id}}">{{$typeRoom->name ?? ''}}</option>
                            @empty
                            <option value="">{{__('No_data')}}</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="hour_price" class="form-label fw-bold">{{__('Room_hour')}}</label>
                        <input type="number" min="0" class="form-control form-control-sm form-control-sm" id="hour_price" name="hour_price" value="{{$currentRoom->hour_price ??'0'}}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="day_price" class="form-label fw-bold">{{__('Room_day')}}</label>
                        <input type="number" min="0" class="form-control form-control-sm form-control-sm" id="day_price" name="day_price" value="{{$currentRoom->day_price ??'0'}}" required>
                    </div>
                    @if(!empty($currentRoom) && array_key_exists($currentRoom->status, \App\Models\Room::UPDATE_STATUS))
                    <div class="col-md-12">
                        <label for="inputState" class="form-label fw-bold">{{__('Room_status')}}</label>
                        <select id="status" name="status" class="form-select">
                            @foreach (\App\Models\Room::UPDATE_STATUS as $key => $item)
                            <option @if($key==$currentRoom->status) selected @endif value="{{$key}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="status_desc" class="form-label fw-bold">{{__('Room_status_description')}}</label>
                        <textarea type="text" class="form-control form-control-sm form-control-sm" id="status_desc" name="status_desc">{{$currentRoom->status_desc ??''}}</textarea>
                    </div>
                    @endif
                    <div class="col-md-12">
                        <label for="day_price" class="form-label fw-bold">{{__('Room_month')}}</label>
                        <input type="number" min="0" class="form-control form-control-sm form-control-sm" id="month_price" name="month_price" value="{{$currentRoom->month_price ??'0'}}" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-sm @if(isset($currentRoom)) btn-success @else btn-primary  @endif">@if(isset($currentRoom)) {{__('Update')}} @else {{__('Create_room')}} @endif</button>
                        @if(!empty($currentRoom))
                        <a href="{{route('rooms.index')}}" class="btn btn-sm btn-primary">{{__('Create')}}</a>
                        @endif
                    </div>
                </form>
            </div>
            @endcan
            @can('Quản lý phòng-list')
            <div class="col">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{__('Room_name')}}</th>
                            <th scope="col">{{__('Price')}}</th>
                            <th scope="col">{{__('Status')}}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $key => $room)
                        <tr>
                            <td>
                                <p><b>{{__('Room')}}:</b> {{$room->name ??''}}</p>
                                <p><b>{{__('Level')}}:</b> {{$room->floor ??''}}</p>
                                <p><b>{{__('Room_type')}}:</b> {{$room->typeRoom->name ?? ''}}</p>
                            </td>
                            <td>
                                <p><b>{{__('Cost_hour')}}:</b> {{get_price($room->hour_price ?? '', 'đ') ??''}}</p>
                                <p><b>{{__('Cost_day')}}:</b>{{get_price($room->day_price ?? '', 'đ') ??''}}</p>
                                <p><b>{{__('Cost_month')}}:</b>{{get_price($room->month_price ?? '', 'đ') ??''}}</p>
                            </td>
                            <td><span class="badge badge-light bg-{{$room->getBgButton()}}">{{\App\Models\Room::ARRAY_STATUS[$room->status ?? 0]}}</span></td>
                            <td style="width:40px">
                                <div class="d-flex">
                                    @can('Quản lý phòng-update')
                                    <a class=" text-warning mr-2 d-inline-block" style="margin-right: 5px;" href="{{route('rooms.edit',['room' => $room])}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                        </svg>
                                    </a>
                                    @endcan
                                    @can('Quản lý phòng-delete')
                                    <form action="{{route('rooms.destroy',['room' => $room])}}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <a href="" class="btn-ajax-delete text-danger  btn-sm ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V4.059L11.882 4H5.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </a>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">{{__('No_data')}}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2 mb-2">
                    {{ $rooms->links('pagination::bootstrap-4') }}
                </div>
                <script>
                    $(document).ready(function() {
                        $('body').on('click', '.btn-ajax-delete', function(e) {
                            e.preventDefault();
                            if (!confirm("{{__('Confirm_delete')}}")) {
                                return false;
                            }

                            $(this).closest('form').submit();
                        })
                    });
                </script>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection