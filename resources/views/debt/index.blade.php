@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>{{$title}}</h5>
                    </div>
                    @can('Quản lý công nợ-list')
                    <div class="table-ajax">
                        @include('debt.table')
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('body').on('change', 'tr .status', function (e) {
            e.preventDefault();

            var _this = $(this);
            var tr = _this.closest('tr');
            var id = tr.data('item_id');
            var status = _this.val();

            $.ajax({
                type: "GET",
                url: "/debts/update-status/" + id,
                data: {
                    id: id,
                    status: status,
                },
                success: function (data) {
                    $('.table-ajax').html(data);
                    $.toast({
                        text: 'Cập nhật thành công',
                        icon: 'success',
                        position: 'top-right'
                    });
                },
                error: function (e) {
                    console.log(e);
                }
            })
        });
    </script>
@endsection