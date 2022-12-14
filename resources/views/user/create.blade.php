@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>{{__('Account_management_f')}}</h5>
                </div>
                @can('Quản lý tài khoản-create')
                <div class="col">
                    <form class="row g-3" method="POST"
                          action="@if(!empty($currentItem)){{route('users.update', ['user'=>$currentItem])}} @else{{route('users.store')}}@endif">
                        @if(!empty($currentItem))
                            {{method_field('PUT')}}
                        @endif
                        <input type="hidden" name="user_id" value="{{$currentItem->id ??''}}"/>
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold">{{__('Username')}}</label>
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control-sm" id="name" name="name"
                                   value="{{$currentItem->name ??''}}" required @if(!empty($currentItem)) readonly @endif>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label fw-bold">{{__('Email')}}</label>
                            <input type="email" class="form-control form-control-sm form-control-sm" id="email" name="email"
                                   value="{{$currentItem->email ??''}}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="password" class="form-label fw-bold">{{__('Password')}}</label>
                            <input type="password" class="form-control form-control-sm form-control-sm" id="password" name="password"
                                   value="" minlength="6">
                        </div>
                        <div class="col-md-12">
                            <label for="re_password" class="form-label fw-bold">{{__('Confirm_password')}}</label>
                            <input type="password" class="form-control form-control-sm form-control-sm" id="re_password" name="re_password"
                                   value="" minlength="6">
                        </div>
                        <div class="col-md-12">
                            <label for="branch_id" class="form-label fw-bold">{{__('Branch')}}</label>
                            <select name="branch_id" id="branch_id" class="form-control form-control-sm" require>
                            <option value="">Mặc định</option>
                                @foreach(\App\Models\Branch::all() as $key => $branch)
                                <option value="{{$branch->id}}" @if(!empty($currentItem) && $currentItem->branch_id == $branch->id) selected @endif>
                                    {{$branch->name ?? ''}}
                                </option>
                                    @endforeach

                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="branch_id" class="form-label fw-bold">{{__('Permission')}}</label>
                            {!! Form::select('roles[]', $roles,$userRole ?? [], array('value' => '{{ old("roles") }}', 'class' => 'form-control')) !!}
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm @if(isset($currentItem)) btn-success @else btn-primary @endif">@if(isset($currentItem)) {{__('Update')}} @else {{__('Create')}} @endif</button>
                            @if(!empty($currentItem))
                                <a href="{{route('users.index')}}" class="btn btn-sm btn-primary">{{__('Create')}}</a>
                            @endif
                        </div>
                        <script>
                            var password = document.getElementById("password");
                            var confirm_password = document.getElementById("re_password");

                            function validatePassword() {
                                if (password.value != confirm_password.value) {
                                    confirm_password.setCustomValidity("{{__('Msg_password_match')}}");
                                } else {
                                    confirm_password.setCustomValidity('');
                                }
                            }

                            password.onchange = validatePassword;
                            confirm_password.onkeyup = validatePassword;
                        </script>
                    </form>
                </div>
                @endcan
                @can('Quản lý tài khoản-list')
                <div class="col">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('Email')}}</th>
                            <th scope="col">{{__('Branch')}}</th>
                            <th scope="col">{{__('Permission')}}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $key => $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name ??''}}</td>
                                <td>{{$user->email ??''}}</td>
                                <td>{{$user->branch->name ?? __('Not_exist')}}</td>
                                <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge rounded-pill bg-primary">{{ $v }}</label>
                                    @endforeach
                                    @endif
                                </td>
                                <td style="width:40px">
                                    <div class="d-flex">
                                    @can('Quản lý tài khoản-update')
                                        <a class=" text-warning mr-2 d-inline-block" style="margin-right: 5px;"
                                           href="{{route('users.edit',['user' => $user])}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                        @endcan
                                        @can('Quản lý tài khoản-delete')
                                        <form action="{{route('users.destroy',['user' => $user])}}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <a href="" class="btn-ajax-delete text-danger  btn-sm ">
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
                                <td colspan="4">{{__('No_data')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        {{ $users->links('pagination::bootstrap-4') }}
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
                @endcan
            </div>
        </div>
    </div>
@endsection
