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
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('Amount_money')}}</th>
                            <th scope="col">{{__('Classify')}}</th>
                            <th scope="col" style="width: 200px">{{__('Time')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $key => $item)
                            <tr>
                                <td>{{$item->id ??''}}</td>
                                <td>{{$item->name ??''}}</td>
                                <td>{{get_price($item->money ?? 0, 'đ')}}</td>
                                <td>{{\App\Models\RevenueAndExpenditure::STATUS[$item->type]}}</td>
                                <td><b>{{__('Created_date')}}</b> {{$item->created_at ?? ''}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">{{__('No_data')}}</td>
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
