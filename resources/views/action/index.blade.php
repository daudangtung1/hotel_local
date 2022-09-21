@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>{{$title ?? ''}}</h5>
                </div>
                <div class="col-md-12">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Số tiền</th>
                            <th scope="col">Phân loại</th>
                            <th scope="col" style="width: 200px">Thời gian</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $key => $item)
                            <tr>
                                <td>{{$item->id ??''}}</td>
                                <td>{{$item->name ??''}}</td>
                                <td>{{get_price($item->money ?? 0, 'đ')}}</td>
                                <td>{{\App\Models\RevenueAndExpenditure::STATUS[$item->type]}}</td>
                                <td><b>Ngày tạo</b> {{$item->created_at ?? ''}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Không có dữ liệu</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        {{ $items->links('pagination::bootstrap-4') }}
                    </div>
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
