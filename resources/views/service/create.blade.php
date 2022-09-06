@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form class="row g-3" method="POST" action="@if(!empty($currentItem)){{route('services.update', ['service'=>$currentItem])}} @else{{route('services.store')}}@endif">
                        @if(!empty($currentItem))
                            {{method_field('PUT')}}
                        @endif
                        @csrf
                        <div class="position-relative">
                        <input type="hidden" name="id" value="{{$currentItem->id ??''}}" />
                        <div class="col-md-12">
                            <label for="name" class="form-label">Tên dịch vụ</label>
                            <input autocomplete="false" type="text" class="form-control  form-control-sm service-name" id="name" name="name" value="{{$currentItem->name ??''}}" required>
                        </div>
                        <div class="col-md-12 col-service d-none list-ajax" style="margin-top: 3px; max-height:250px; overflow-y:scroll ">
                            @foreach ($services as $service)
                            <a data-id="{{ $service->id }}" class="list-group-item list-group-item-action" style="cursor: pointer">
                                {{ ucfirst($service->name) }} 
                              </a>
                            @endforeach
                        </div>     
                        </div>                   
                        <div class="col-md-12">
                            <label for="floor" class="form-label">Số lượng</label>
                            <input type="number" min="0" max="1000" class="form-control  form-control-sm" name="stock" id="stock" value="{{$currentItem->stock ??'100'}}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Loại dịch vụ</label>
                            <select id="type" name="type" class="form-select" required>
                                <option @if(!empty($currentItem) && $currentItem->type == 0) selected @endif value="0">Đồ ăn</option>
                                <option @if(!empty($currentItem) && $currentItem->type == 1) selected @endif value="1">Đồ uống</option>
                                <option @if(!empty($currentItem) && $currentItem->type == 2) selected @endif value="2">Dịch vụ khác</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="sale_type" class="form-label">Loại dịch vụ</label>
                            <select id="sale_type" name="sale_type" class="form-select" required>
                                <option @if(!empty($currentItem) && $currentItem->sale_type == 0) selected @endif value="0">Dịch vụ theo ngày</option>
                                <option @if(!empty($currentItem) && $currentItem->sale_type == 1) selected @endif value="1">dịch vụ theo lần sử dụng</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control  form-control-sm" id="price" name="price" value="{{$currentItem->price ??'0'}}" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary">@if(isset($currentItem)) Cập nhật @else Tạo mới @endif</button>
                                @if(!empty($currentItem))
                                    <a href="{{route('services.index')}}" class="btn btn-sm btn-primary">Tạo mới</a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Tên dịch vụ</th>
                            <th scope="col">Tồn kho</th>
                            <th scope="col">Giá</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($services as $key => $service)
                            <tr>
                                <td>{{$service->id ??''}}</td>
                                <td>{{$service->name ??''}}</td>
                                <td>{{$service->getSaleType() ??''}}</td>
                                <td>{{$service->stock ??''}}</td>
                                <td>{{get_price($service->price, 'đ') ??''}}</td>
                                <td style="width:40px">
                                    <div class="d-flex">
                                        <a class=" text-warning mr-2 d-inline-block" style="margin-right: 5px;" href="{{route('services.edit',['service' => $service])}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                        <form action="{{route('services.destroy',['service' => $service])}}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <a href="" class="btn-ajax-delete text-danger  btn-sm ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Không có khách hàng nào</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        {{ $services->links('pagination::bootstrap-4') }}
                    </div>
                    <script>
                        $(document).ready(function(){
                            $('body').on('click', '.btn-ajax-delete', function(e){
                                e.preventDefault();
                                if(!confirm('Bạn chắc chắn muốn xóa chứ?')) {
                                    return false;
                                }

                                $(this).closest('form').submit();
                            });

                            $('.service-name').on('focus', function(e) {
                                $('.col-service').removeClass('d-none')
                            });

                            $('.service-name').on('keyup', function(e) {
                                $('.col-service').addClass('d-none')
                            });

                            $('.list-group-item').on('click', function(e) {
                                var serviceId = $(this).data('id');
                                var textService = $(this).text().trim();

                                $('input[name="id"]').val(serviceId);
                                $('.col-service').addClass('d-none');
                                $('input[name="name"]').val(textService);
                            })
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
