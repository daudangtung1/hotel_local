@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form class="row g-3" method="POST"
                          action="@if(!empty($currentRoom)){{route('rooms.update', ['room'=>$currentRoom])}} @else{{route('rooms.store')}}@endif">
                        @if(!empty($currentRoom))
                            {{method_field('PUT')}}
                        @endif
                        <input type="hidden" name="room_id" value="{{$currentRoom->id ??''}}"/>
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Tên phòng</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{$currentRoom->name ??''}}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="floor" class="form-label">Tầng</label>
                            <input type="text" class="form-control" id="floor" name="floor"
                                   value="{{$currentRoom->floor ??''}}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Loại phòng</label>
                            <select id="type" name="type" class="form-select" required>
                                <option @if($currentRoom && $currentRoom->type == 0) selected @endif value="0">Phòng đơn</option>
                                <option @if($currentRoom && $currentRoom->type == 1) selected @endif value="1">Phòng đôi</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="hour_price" class="form-label">Giá phòng / giờ</label>
                            <input type="number" min="0" class="form-control" id="hour_price" name="hour_price"
                                   value="{{$currentRoom->hour_price ??'0'}}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="day_price" class="form-label">Giá phòng / ngày</label>
                            <input type="number" min="0" class="form-control" id="day_price" name="day_price"
                                   value="{{$currentRoom->day_price ??'0'}}" required>
                        </div>

                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Trạng thái</label>
                            <select id="type" name="status" class="form-select" required>
                                @foreach (\App\Models\Room::ARRAY_STATUS as $key => $status)
                                    <option
                                        {{ old('status') == $key || (!empty($currentRoom) && $currentRoom->status == $key) ? 'selected' : ''}} value="{{ $key }}">{{ $status  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">@if(isset($currentRoom)) Cập nhật @else Tạo
                                phòng @endif</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Tên phòng</th>
                            <th scope="col">Tầng</th>
                            <th scope="col">Giá / giờ</th>
                            <th scope="col">Giá / ngày</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rooms as $key => $room)
                            <tr>
                                <td>{{$room->name ??''}}</td>
                                <td>{{$room->floor ??''}}</td>
                                <td>{{get_price($room->hour_price, 'đ') ??''}}</td>
                                <td>{{get_price($room->day_price, 'đ') ??''}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-warning mr-2 d-inline-block" style="margin-right: 5px;"
                                           href="{{route('rooms.edit',['room' => $room])}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                        <form action="{{route('rooms.destroy',['room' => $room])}}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <a href="" class="btn-ajax-delete btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Không có khách hàng nào</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('body').on('click', '.btn-ajax-delete', function (e) {
                                e.preventDefault();
                                if (!confirm('Bạn chắc chắn muốn xóa chứ?')) {
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
