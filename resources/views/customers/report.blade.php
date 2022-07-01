@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Báo cáo khách</h5>
                        <div class="filter">
                            <form action="{{route('customers.report')}}" class="d-flex" method="GET">
                                <input type="text" name="name" class="form-control me-2" placeholder="name" value="@if(!empty(request()->name)) {{request()->name}} @endif">
                                <input type="text" class="form-control me-2 filter-date" placeholder="CMND/HC" name="id_card" value="@if(!empty(request()->id_card)) {{request()->id_card}} @endif"  autocomplete="false">
                                <button class="btn btn-success me-2">Lọc</button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Tên</th>
                            <th scope="col">CMND/HC</th>
                            <th scope="col">Điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($customers as $key => $customer)
                            <tr>
                                <td>{{$customer->name ??''}}</td>
                                <td>{{$customer->id_card ??''}}</td>
                                <td>{{$customer->phone ??''}}</td>
                                <td>{{$customer->address ??''}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">Không có khách hàng nào</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-2 mb-2">
                    {{ $customers->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
