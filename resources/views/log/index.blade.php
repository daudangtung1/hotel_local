@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>{{__('Log_management')}}</h5>
                    @include('log.form-filter')
                    <table class="table table-sm table-bordered table-hover">
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('URL')}}</th>
                            <th>{{__('Ip')}}</th>
                            <th>{{__('User')}}</th>
                            <th>{{__('Created_date')}}</th>
                        </tr>
                        @if($logs->count())
                            @foreach($logs as $key => $log)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $log->subject ?? '' }}</td>
                                    <td class="text-success">{{ $log->url ?? '' }}</td>
                                    <td class="text-warning">{{ $log->ip ?? '' }}</td>
                                    <td>{{ $log->user->name ?? __('Not_exist') }}</td>
                                    <td>{{ $log->created_at ?? ''}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        {{ $logs->links('pagination::bootstrap-4') }}
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('body').on('click', '.btn-ajax-delete', function (e) {
                                e.preventDefault();
                                if (!confirm("{{__('Confirm_delete')}}")) {
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
