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
                            <th>#</th>
                            <th scope="col">{{__('Group_name')}}</th>
                            <th scope="col">{{__('Note')}}</th>
                            <th scope="col">{{__('Booking_date')}}</th>
                            <th scope="col">{{__('Customer')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($groups as $key => $group)
                            <tr>
                                <td>{{$group->id ??''}}</td>
                                <td>{{$group->name ??''}}</td>
                                <td>{{$group->note ?? ''}}</td>
                                <td>{{$group->start_date ??''}}</td>
                                <td>
                                    <p>{{$group->customer_name ?? ''}} - {{$group->customer_phone ?? ''}}</p>
                                </td>
                                <td style="width:40px">
                                    <div class="d-flex">
                                    @can('Quản lý khách đoàn-update')
                                        <form action="{{route('groups.booking_info')}}">
                                            <input type="hidden" id="group_id" name="group_id"  value="{{$group->id}}">
                                            <input type="hidden" id="customer_id" name="customer_id"  value="{{$group->customer_id}}">
                                            <input type="hidden" id="start_date" name="group_id"  value="{{$group->start_date}}">
                                            <input type="hidden" id="end_date" name="group_id"  value="{{$group->end_date}}">
                                            <a class="btn-ajax-edit text-warning mr-2 d-inline-block" style="margin-right: 5px; cursor: pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                            </a>
                                        </form>
                                        @endcan
                                        @can('Quản lý khách đoàn-delete')
                                        <form action="{{route('groups.show',['group' => $group])}}"
                                              method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <a class="btn-ajax-delete text-danger  btn-sm ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">{{__('No_group')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        {{ $groups->links('pagination::bootstrap-4') }}
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('body').on('click', '.btn-ajax-delete', function (e) {
                                e.preventDefault();
                                if (!confirm("{{__('Confirm_delete')}}")) {
                                    return false;
                                }

                                $(this).closest('form').submit();
                            });

                            $('body').on('click', '.btn-ajax-edit', function(e) {

                                var form = $(this).closest('form');
                                var group_id = form.find('#group_id').val();
                                var customer_id = form.find('#customer_id').val();
                                var start_date = form.find('#start_date').val();
                                var end_date = form.find('#end_date').val();

                                $.ajax({
                                    type: "GET",
                                    url: "{{route('groups.booking_info')}}",
                                    data: {
                                        group_id: group_id,
                                        customer_id: customer_id,
                                        start_date: start_date,
                                        end_date: end_date
                                    },
                                    success: function (data) {
                                        $('#group-customer-booking').html('').html(data);
                                        $('#group-customer-booking').modal('show');
                                        var start_date = $('#group-customer-booking').find('#start_date');
                                        var end_date = $('#group-customer-booking').find('#end_date');
                                        if (start_date) {
                                            start_date.datetimepicker({
                                                todayHighlight: true,
                                                format: 'Y-m-d H:i',
                                                startDate: new Date()
                                            });
                                        }

                                        if (end_date) {
                                            end_date.datetimepicker({
                                                todayHighlight: true,
                                                format: 'Y-m-d H:i',
                                                endDate: new Date()
                                            });
                                        }

                                    // setTimeout(function () {
                                    //     $('#booking-room').find('#end_date').trigger('change');
                                    // }, 300);
                                    },
                                    error: function(error) {
                                        console.log(error)
                                    }
                                })
                            })

                            $('body').on('click', '.btn-cancel-booking-group', function(e) {
                                var modal = $(this).closest('.modal');
                                var group_id = modal.find('#group_id').val();
                                console.log(group_id)
                                $.ajax({
                                    type: "delete",
                                    url: "{{route('groups.cancel_booking')}}",
                                    data: {
                                        group_id: group_id
                                    },
                                    success: function (data) {
                                        if (typeof data.response !== 'undefined') {
                                            $.toast({
                                                text: data.response.message,
                                                icon: 'error',
                                                position: 'top-right'
                                            });
                                            return false;
                                        }
                                        modal.modal('hide');
                                        $.toast({
                                            text: "{{__('Msg_cancel_room')}}",
                                            icon: 'success',
                                            position: 'top-right'
                                        });
                                    },
                                    error: function(error) {
                                        console.log(error)
                                    }
                                })
                            })
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
