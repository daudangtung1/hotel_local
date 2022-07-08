@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>{{$title ?? ''}}</h5>
                        <div class="filter">
                            <form action="{{route('services.report')}}" class="d-flex" method="GET">
                                <input type="text" class="form-control me-2 filter-date" placeholder="Ngày bắt đầu" name="start_date" value="@if(!empty(request()->start_date)) {{request()->start_date}} @endif"  autocomplete="false">
                                <input type="text" class="form-control me-2 filter-date" placeholder="Ngày kết thúc" name="end_date" value="@if(!empty(request()->end_date)) {{request()->end_date}} @endif" autocomplete="false">

                                <button class="btn btn-success me-2 whitespace-nowrap"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                    </svg>Lọc</button>
                                <button class="btn btn-danger whitespace-nowrap" type="submit" name="export" value="export" >Xuất Excel</button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Tên dịch vụ</th>
                            <th scope="col">Tồn kho</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Loại dịch vụ</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Ngày tạo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($services as $key => $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->stock }}</td>
                                <td>{{ get_price($service->price, 'đ') }}</td>
                                <td>{{ \App\Models\Service::ARRAY_SERVICE_TYPE[$service->type] }}</td>
                                <td>{{ $service->user->name ?? '' }}</td>
                                <td>{{ \Carbon\Carbon::parse($service->created_at)->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">Không có dịch vụ nào</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-2 mb-2">
                    {{ $services->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('body').on('change', '#by', function(e){
                $(this).closest('form').submit();
            });

            var date = $('.filter-date');
            if (date) {
                date.datetimepicker({
                    todayHighlight: true,
                    format: 'Y-m-d',
                    startDate: new Date()
                });
            }
        });
    </script>
@endsection
