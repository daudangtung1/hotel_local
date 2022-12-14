@extends('layouts.app')
@section('content')

<div class="wrap-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="card-title mb-0">{{$title}}</h2>
                    @can('Quản lý quyền-create')
                    <div class="card-tools">
                        <a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fas fa-plus"></i> {{__('Create')}}</a>
                    </div>
                    @endcan
                </div>
            </div>
            @can('Quản lý quyền-list')
            <div class="col-md-12">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">{{__('Role')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $key => $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name ??''}}</td>
                            <td style="width:40px">
                                <div class="d-flex">
                                @can('Quản lý quyền-update')
                                    <a class=" text-warning mr-2 d-inline-block" style="margin-right: 5px;" href="{{route('roles.edit',['role' => $role])}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                        </svg>
                                    </a>
                                    @endcan
                                    @can('Quản lý quyền-delete')
                                    <form action="{{route('roles.destroy',['role' => $role])}}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <a href="" class="btn-ajax-delete text-danger  btn-sm ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </a>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">{{__('No_data')}}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2 mb-2">
                    {{ $roles->links('pagination::bootstrap-4') }}
                </div>
                <script>
                    $(document).ready(function() {
                        $('body').on('click', '.btn-ajax-delete', function(e) {
                            e.preventDefault();
                            if (!confirm("{{__('Confirm_delete')}}")) {
                                return false;
                            }

                            $(this).closest('form').submit();
                        })
                    });
                </script>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection