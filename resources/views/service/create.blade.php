@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form class="row g-3" method="POST" action="{{route('services.store')}}">
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Tên dịch vụ</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-12">
                            <label for="floor" class="form-label">Số lượng</label>
                            <input type="text" class="form-control" name="stock" id="stock" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Loại dịch vụ</label>
                            <select id="type" name="type" class="form-select" required>
                                <option selected value="0">Đồ ăn</option>
                                <option value="1">Đồ uống</option>
                                <option value="2">Dịch vụ khác</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" value="0" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Tạo dịch vụ</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Tên dịch vụ</th>
                            <th scope="col">Tồn kho</th>
                            <th scope="col">Giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($services as $key => $service)
                            <tr>
                                <td>{{$service->name ??''}}</td>
                                <td>{{$service->stock ??''}}</td>
                                <td>{{get_price($service->price, 'đ') ??''}}</td>
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
