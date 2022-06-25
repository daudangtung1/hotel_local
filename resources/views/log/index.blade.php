@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>Quản lý nhật ký</h5>
                    <table class="table table-sm table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>URL</th>
                            <th>Method</th>
                            <th>Ip</th>
                            <th width="300px">User Agent</th>
                            <th>Người dùng</th>
                        </tr>
                        @if($logs->count())
                            @foreach($logs as $key => $log)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $log->subject ?? '' }}</td>
                                    <td class="text-success">{{ $log->url ?? '' }}</td>
                                    <td><label class="label label-info">{{ $log->method ?? '' }}</label></td>
                                    <td class="text-warning">{{ $log->ip ?? '' }}</td>
                                    <td class="text-danger">{{ $log->agent ?? '' }}</td>
                                    <td>{{ $log->user->name ?? '' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
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
