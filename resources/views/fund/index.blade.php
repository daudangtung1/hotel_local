@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>{{$title ?? ''}}</h5>
                </div>
                <br />
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Quản lý doanh thu</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Quản lý thu/chi</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên phòng</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Tên khách hàng</th>
                                    <th>Hình thức</th>
                                    <th>Tiền phòng</th>
                                    <th>Tiền dịch vụ</th>
                                    <th>Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($bookingRooms))
                                    @forelse($bookingRooms as $key => $bookingRoom)
                                        <tr>
                                            <td>{{$bookingRoom->id}}</td>
                                            <td>
                                                <p><b>Phòng</b> {{$bookingRoom->room->name ?? 'Không tồn tại'}}</p>
                                                <p><b>Tầng:</b> {{$bookingRoom->room->floor ?? 'Không tồn tại'}}</p>
                                            </td>
                                            <td>
                                                <p><b>Ngày vào: </b>{{$bookingRoom->start_date ?? ''}}</p>
                                                <p><b>Ngày ra: </b>{{$bookingRoom->end_date ?? ''}}</p>
                                            </td>
                                            <td>
                                                @foreach($bookingRoom->bookingRoomCustomers()->get() as $customer)
                                                    <p>{{$customer->customer->name ?? 'Không tồn tại'}}</p>
                                                @endforeach
                                            </td>
                                            <td>{{$bookingRoom->getRentType()}}</td>
                                            <td>{{$bookingRoom->getTotalPrice(false)}}</td>
                                            <td>{{get_price($bookingRoom->getTotalServices(), 'đ') ?? ''}}</td>
                                            <td>{{$bookingRoom->getTotalPrice() ?? ''}}</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Không có dữ liệu</td>
                                        </tr>
                                    @endforelse
                                @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-2 mb-2">
                                {{ $bookingRooms->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Số tiền</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Phân loại</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($items as $key => $item)
                                    <tr>
                                        <td>{{$item->id ??''}}</td>
                                        <td>{{$item->name ??''}}</td>
                                        <td>{{get_price($item->money ?? 0, 'đ')}}</td>
                                        <td>{{$item->created_at ?? ''}}</td>
                                        <td>{{\App\Models\RevenueAndExpenditure::STATUS[$item->type]}}</td>
                                        <td style="width:40px">
                                            <div class="d-flex">
                                                <a class=" text-warning mr-2 d-inline-block" style="margin-right: 5px;"
                                                   href="{{route('revenue-and-expenditures.edit',['revenue_and_expenditure' => $item])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                    </svg>
                                                </a>
                                                <form action="{{route('revenue-and-expenditures.destroy',['revenue_and_expenditure' => $item])}}" method="POST">
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
                                        <td colspan="5">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-2 mb-2">
                                {{ $items->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                        </div>
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
