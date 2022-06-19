@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form class="row g-3" method="POST" action="{{route('rooms.store')}}">
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Tên phòng</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-12">
                            <label for="floor" class="form-label">Tầng</label>
                            <input type="text" class="form-control" id="floor" id="floor" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Loại phòng</label>
                            <select id="type" name="type" class="form-select" required>
                                <option selected value="0">Phòng đơn</option>
                                <option value="1">Phòng đôi</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="hour_price" class="form-label">Giá phòng / giờ</label>
                            <input type="number" class="form-control" id="hour_price" name="hour_price" value="0" required>
                        </div>
                        <div class="col-md-12">
                            <label for="day_price" class="form-label">Giá phòng / ngày</label>
                            <input type="number" class="form-control" id="day_price" name="day_price" value="0" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Tạo phòng</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Tên phòng </th>
                            <th scope="col">Tầng</th>
                            <th scope="col">Giá / giờ</th>
                            <th scope="col">Giá / ngày</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rooms as $key => $room)
                            <tr>
                                <td>{{$room->name ??''}}</td>
                                <td>{{$room->floor ??''}}</td>
                                <td>{{get_price($room->hour_price, 'vnđ') ??''}}</td>
                                <td>{{get_price($room->day_price, 'vnđ') ??''}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Không có khách hàng nào</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
