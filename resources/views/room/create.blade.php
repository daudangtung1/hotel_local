@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <form class="row g-3" method="POST" action="{{route('rooms.store')}}">
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label">Tên phòng</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="floor" class="form-label">Tầng</label>
                    <input type="text" class="form-control" id="floor" id="floor" required>
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Loại phòng</label>
                    <select id="type" name="type" class="form-select" required>
                        <option selected value="0">Phòng đơn</option>
                        <option value="1">Phòng đôi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label">Giá phòng</label>
                    <input type="number" class="form-control" id="price" name="price" value="0" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Tạo phòng</button>
                </div>
            </form>
        </div>
    </div>
@endsection
