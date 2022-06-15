@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <form class="row g-3" method="POST" action="{{route('services.store')}}">
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label">Tên dịch vụ</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="floor" class="form-label">Số lượng</label>
                    <input type="text" class="form-control" name="stock" id="stock" required>
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Loại dịch vụ</label>
                    <select id="type" name="type" class="form-select" required>
                        <option selected value="0">Đồ ăn</option>
                        <option value="1">Đồ uống</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label">Giá</label>
                    <input type="number" class="form-control" id="price" name="price" value="0" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Tạo phòng</button>
                </div>
            </form>
        </div>
    </div>
@endsection
