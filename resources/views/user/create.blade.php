@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>Quản lý tài khoản</h5>
                </div>
                <div class="col-md-4">
                    <form class="row g-3" method="POST"
                          action="@if(!empty($currentItem)){{route('users.update', ['user'=>$currentItem])}} @else{{route('users.store')}}@endif">
                        @if(!empty($currentItem))
                            {{method_field('PUT')}}
                        @endif
                        <input type="hidden" name="user_id" value="{{$currentItem->id ??''}}"/>
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Tên tài khoản</label>
                            <input type="text" class="form-control form-control-sm form-control-sm" id="name" name="name"
                                   value="{{$currentItem->name ??''}}" required @if(!empty($currentItem)) readonly @endif>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-sm form-control-sm" id="email" name="email"
                                   value="{{$currentItem->email ??''}}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control form-control-sm form-control-sm" id="password" name="password"
                                   value="" minlength="6">
                        </div>
                        <div class="col-md-12">
                            <label for="re_password" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control form-control-sm form-control-sm" id="re_password" name="re_password"
                                   value="" minlength="6">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary">@if(isset($currentItem)) Cập nhật @else Tạo
                                phòng @endif</button>
                            @if(!empty($currentItem))
                                <a href="{{route('users.index')}}" class="btn btn-sm btn-primary">Tạo mới</a>
                            @endif
                        </div>
                        <script>
                            var password = document.getElementById("password");
                            var confirm_password = document.getElementById("re_password");

                            function validatePassword() {
                                if (password.value != confirm_password.value) {
                                    confirm_password.setCustomValidity("Passwords Don't Match");
                                } else {
                                    confirm_password.setCustomValidity('');
                                }
                            }

                            password.onchange = validatePassword;
                            confirm_password.onkeyup = validatePassword;
                        </script>
                    </form>
                </div>
                <div class="col-md-8">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $key => $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name ??''}}</td>
                                <td>{{$user->email ??''}}</td>
                                <td style="width:40px">
                                    <div class="d-flex">
                                        <a class=" text-warning mr-2 d-inline-block" style="margin-right: 5px;"
                                           href="{{route('users.edit',['user' => $user])}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
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
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Không có dữ liệu</td>
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
