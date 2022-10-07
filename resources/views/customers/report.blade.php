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
                                <input type="text" autocomplete="off"  name="name" class="form-control form-control-sm me-2" placeholder="name" value="@if(!empty(request()->name)) {{request()->name}} @endif">
                                <input type="text" autocomplete="off"  class="form-control form-control-sm me-2 filter-date" placeholder="CMND/HC" name="id_card" value="@if(!empty(request()->id_card)) {{request()->id_card}} @endif"  autocomplete="off">

                                <button class="btn btn-success me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                    </svg>Lọc</button>
                                <button class="btn btn-danger" type="submit" name="export" value="export" >Xuất Excel</button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Tên</th>
                            <th scope="col">CMND/HC</th>
                            <th scope="col">Điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($customers as $key => $customer)
                            <tr>
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->name ??''}}</td>
                                <td>{{$customer->id_card ??''}}</td>
                                <td>{{$customer->phone ??''}}</td>
                                <td>{{$customer->address ??''}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">Không có dữ liệu</td>
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
