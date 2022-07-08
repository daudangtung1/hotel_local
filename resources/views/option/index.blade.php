@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>Cài đặt thông tin cơ sở</h5>
                </div>
                <div class="col-md-12">
                    <form class="row g-3" method="POST" action="{{route('options.update_all')}}">
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Tên công ty</label>
                            <input type="text" class="form-control  form-control-sm" id="name" name="name"
                                   value="{{$option->name ?? ''}}">
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control  form-control-sm" id="address" name="address"
                                   value="{{$option->address ?? ''}}">
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="form-label">Điện thoại</label>
                            <input type="text" class="form-control  form-control-sm" id="phone" name="phone"
                                   value="{{$option->phone ?? ''}}">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control  form-control-sm" id="email" name="email"
                                   value="{{$option->email ?? ''}}">
                        </div>
                        <div class="col-md-12">
                            <label for="fax" class="form-label">Fax</label>
                            <input type="text" class="form-control  form-control-sm" id="fax" name="fax"
                                   value="{{$option->fax ?? ''}}">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
