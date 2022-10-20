@if (\Auth::check())
<header class="main-header clearfix">
    <div class="container clearfix">
        <div class="wrap-tab">
            <div class="top-tab">
                <ul>
                    <li class="@if(!empty($menuSystem)) is_active  @endif"><a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 122.88 105.02" style="enable-background:new 0 0 122.88 105.02" xml:space="preserve" class="image-svg replaced-svg svg-replaced-0">
                                <g>
                                    <path d="M97.25,40.58l23.85,10.28c1.48,0.64,2.17,2.36,1.53,3.85c-0.32,0.75-0.93,1.3-1.63,1.57l-23.19,9.39l23.29,10.04 c1.48,0.64,2.17,2.36,1.53,3.84c-0.32,0.75-0.93,1.3-1.63,1.57l-58.52,23.69c-0.73,0.3-1.52,0.27-2.2,0L1.83,81.05 c-1.5-0.61-2.22-2.31-1.61-3.81c0.33-0.82,0.99-1.4,1.76-1.67l22.97-9.96l-23.12-9.4c-1.5-0.61-2.22-2.31-1.61-3.81 c0.33-0.82,0.99-1.4,1.76-1.67l23.53-10.21L1.83,30.9c-1.5-0.61-2.22-2.31-1.61-3.81c0.33-0.82,0.99-1.4,1.76-1.67L60.02,0.24 c0.77-0.33,1.6-0.31,2.31,0l0-0.01l58.77,25.32c1.48,0.64,2.17,2.36,1.53,3.84c-0.32,0.75-0.93,1.3-1.63,1.57L97.25,40.58 L97.25,40.58z M112.36,53.47l-22.73-9.79L62.49,54.66c-0.73,0.3-1.52,0.27-2.2,0L33.08,43.6L10.47,53.4L61.39,74.1L112.36,53.47 L112.36,53.47z M90.19,68.75l-27.7,11.21c-0.73,0.3-1.52,0.27-2.2,0L32.52,68.68l-22.05,9.56l50.92,20.69l50.97-20.63L90.19,68.75 L90.19,68.75z M61.17,6.1l-50.7,21.99l50.92,20.69l50.97-20.63L61.17,6.1L61.17,6.1z"></path>
                                </g>
                            </svg>
                            <span>Hệ Thống</span></a></li>
                    <li class="@if(!empty($menuCategoryManager)) is_active  @endif"><a href="#"><img class="" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/icon-quanly.png"><span>Danh Mục Quản Lý</span></a>
                    </li>
                    <li class="@if(!empty($menuReport)) is_active  @endif"><a href="#"><img class="" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/icon-bcthongke.png"><span>Báo cáo - thống kê</span></a>
                    </li>
                    <li class="@if(!empty($menuSetup)) is-active @endif"><a href="#"><img class="" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/icon-thietlapbandau.png"><span>Thiết lập ban đầu</span></a>
                    </li>
                    <li class="@if(!empty($menuHelp)) is_active  @endif"><a href="#"><img class="" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/icon-trogiup.png"><span>Trợ giúp</span></a>
                    </li>
                    <li>Xin chào: <b>{{\Auth::user()->name ?? ''}}</b>!</li>
                </ul>
            </div>
            <div class="content-tab">
                <div class="info-content @if(!empty($menuSystem)) active  @endif">
                    <div class="inner-info-content">
                        @can('Quản lý dịch vụ-list')
                        <div class="ql_tk tl_chung">
                            <ul>
                                <li>
                                    <a href="{{route('services.create')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/nhaphang.png"></a>
                                    <span>Nhập hàng</span>
                                </li>
                            </ul>
                            <span class="text_tlc">Quản lý kho</span>
                        </div>
                        @endcan
                        @can('Quản lý hóa đơn-prinf')
                        <div class="ql_tk">
                            <a href="{{ route('booking-room.booking_room_used') }}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/inhoadon.png"></a>
                            <span>In hóa đơn</span>
                        </div>
                        @endcan
                        <div class="ql_tk tl_chung">
                            <ul>
                                @if ( auth()->check())
                                <li>
                                    <a href="{{route('users.edit',['user' => auth()->user()])}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/doimatkhau.png"></a>
                                    <span>Đổi mật khẩu</span>
                                </li>
                                @endif
                                <li>
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf
                                        <a href="#" class="logout"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/dangxuat.png"></a>
                                        <span>Đăng xuất</span>
                                    </form>
                                    <script>
                                        $(document).ready(function() {
                                            $('.logout').on('click', function() {
                                                $(this).closest('form').submit();
                                            });
                                        });
                                    </script>
                                </li>
                            </ul>
                            <span class="text_tlc">Hệ thống</span>
                        </div>
                        <div class="ql_tk tl_chung">
                            <ul>
                                <li>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#" id="dropdownTypeRoom" data-bs-toggle="dropdown" aria-expanded="false"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/loaiphong.png"><span>Loại phòng</span></a>
                                    <ul id="list-type-rooms" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item">Tất cả loai phòng</a></li>
                                        @foreach (\App\Models\Room::ARRAY_STATUS as $key => $item)
                                        <li data-value="{{$key}}"><a class="dropdown-item">{{$item}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a class="nav-link dropdown-toggle" role="button" id="dropdownFloor" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 51.913 51.913" style="enable-background:new 0 0 51.913 51.913;" xml:space="preserve" class="image-svg replaced-svg svg-replaced-9">
                                            <path d="M50.957,7c0-4.596-12.577-7-25-7s-25,2.404-25,7c0,1.042,0.652,1.97,1.796,2.784l17.204,23.542v17.525l0.062,1.062h1  l0.457-0.018l10.481-10.481v-8.088L49.16,9.784C50.305,8.97,50.957,8.042,50.957,7z M25.957,2c14.04,0,23,2.961,23,5s-8.96,5-23,5  s-23-2.961-23-5S11.917,2,25.957,2z"></path>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                        </svg>
                                        <span>Khu vực</span>
                                    </a>
                                    <ul id="list-floor" class="dropdown-menu" aria-labelledby="dropdownFloor">
                                        <li><a class="dropdown-item">Tất cả</a></li>
                                        @foreach(\App\Models\Room::getUniqueFloor() as $floor)
                                        <li data-value="{{ $floor->name ?? '' }}"><a class="dropdown-item">{{ $floor->name ?? ''}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a class="nav-link dropdown-toggle" role="button" id="dropdownOrder" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 51.913 51.913" style="enable-background:new 0 0 51.913 51.913;" xml:space="preserve" class="image-svg replaced-svg svg-replaced-9">
                                            <path d="M50.957,7c0-4.596-12.577-7-25-7s-25,2.404-25,7c0,1.042,0.652,1.97,1.796,2.784l17.204,23.542v17.525l0.062,1.062h1  l0.457-0.018l10.481-10.481v-8.088L49.16,9.784C50.305,8.97,50.957,8.042,50.957,7z M25.957,2c14.04,0,23,2.961,23,5s-8.96,5-23,5  s-23-2.961-23-5S11.917,2,25.957,2z"></path>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                            <g></g>
                                        </svg>
                                        <span>sắp xếp</span>
                                    </a>

                                    <ul id="drop-down-order" class="dropdown-menu" aria-labelledby="dropdownOrder">
                                        <li data-value="DESC"><a class="dropdown-item">Giảm dần</a></li>
                                        <li data-value="ASC"><a class="dropdown-item">Tăng dần</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <span class="text_tlc filter_room">Lọc và sắp xếp</span>
                        </div>
                    </div>
                </div>
                <div class="info-content @if(!empty($menuCategoryManager)) active  @endif">
                    <div class="inner-info-content">
                        <div class="ql_tk tl_chung">
                            <ul>
                                @can('Quản lý thu chi-list')
                                <li>
                                    <a href="{{route('revenue-and-expenditures.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/thuchi01.png"></a>
                                    <span>Thu chi</span>
                                </li>
                                @endcan
                                @can('Quản lý quỹ-list')
                                <li>
                                    <a href="{{route('funds.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/qlquy01.png"></a>
                                    <span>QL Quỹ</span>
                                </li>
                                @endcan
                                @can('Quản lý giao ca-list')
                                <li>
                                    <a href="{{route('shifts.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/giaoca01.png"></a>
                                    <span>Giao ca</span>
                                </li>
                                @endcan
                            </ul>
                            @can('Quản lý thu chi-list')
                            <span class="text_tlc">Quản lý thu chi</span>
                            @endcan
                        </div>
                        <div class="ql_tk tl_chung">
                            <ul>
                                @can('Quản lý khách hàng-list')
                                <li>
                                    <a href="{{route('customers.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/danhsach01.png"></a>
                                    <span>Danh sách</span>
                                </li>
                                @endcan
                                @can('Quản lý báo cáo-Báo cáo')
                                <li>
                                    <a href="{{ route('customers.report') }}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/bckhach01.png"></a>
                                    <span>BC khách</span>
                                </li>
                                @endcan
                                @can('Quản lý đồ thất lạc-list')
                                <li>
                                    <a href="{{route('lost-items.create')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/dothatlac01.png"></a>
                                    <span>Đồ thất lạc</span>
                                </li>
                                @endcan
                            </ul>
                            @can('Quản lý khách hàng-list')
                            <span class="text_tlc">Khách hàng</span>
                            @endcan
                        </div>

                        <div class="ql_tk tl_chung">
                            <ul>
                                @can('Quản lý chi nhánh-list')
                                <li>
                                    <a href="{{route('branchs.create')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/qldatphong01.png"></a>
                                    <span>QL chi nhánh</span>
                                </li>
                                @endcan
                                @can('Quản lý đặt phòng-list')
                                <li>
                                    <a href="{{route('rooms.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/qldatphong01.png"></a>
                                    <span>QL Đặt Phòng</span>
                                </li>
                                @endcan
                                @can('Quản lý khách đoàn-list')
                                <li class="group-customer-booking">
                                    <a href="#"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/khachdoan01.png"></a>
                                    <span>Khách đoàn</span>
                                </li>
                                <li>
                                    <a href="{{route('groups.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/tradoan01.png"></a>
                                    <span>Trả đoàn</span>
                                </li>
                                @endcan
                            </ul>
                            @can('Quản lý đặt phòng-list')
                            <span class="text_tlc">Đặt phòng và khách đoàn</span>
                            @endcan
                        </div>

                    </div>
                </div>
                <div class="info-content @if(!empty($menuReport)) active  @endif">
                    <div class="inner-info-content">
                    @can('Quản lý báo cáo-Báo cáo')
                        <div class="ql_tk tl_chung">
                            <ul>
                                
                                <li>
                                    <a href="{{route('reports.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/bgtonghop.png"></a>
                                    <span>BC Tổng hợp</span>
                                </li>
                                <li>
                                    <a href="#"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/congno.png"></a>
                                    <span>Công nợ</span>
                                </li>
                                
                            </ul>
                            <span class="text_tlc">Báo cáo</span>
                        </div>
                        <div class="ql_tk tl_chung">
                            <ul>
                                <li>
                                    <a href="{{ route('services.report') }}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/bcnhaphang.png"></a>
                                    <span>BC nhập hàng</span>
                                </li>
                                <li>
                                    <a href="{{ route('booking-room-service.report') }}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/bcbanhang.png"></a>
                                    <span>BC bán hàng</span>
                                </li>
                                <li>
                                    <a href="{{route('services.create')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/qlkho.png"></a>
                                    <span>Quản lý kho</span>
                                </li>
                            </ul>
                            <span class="text_tlc">Quản lý kho</span>
                        </div>
                        @endcan
                        @can('Quản lý nhật ký-Nhật ký')
                        <div class="ql_tk tl_chung">
                            <ul>
                                <li>
                                    <a href="{{route('logs.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/hethong.png"></a>
                                    <span>Hệ thống</span>
                                </li>
                            </ul>
                            <span class="text_tlc">Nhật ký</span>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="info-content @if(!empty($menuSetup)) active  @endif">
                    <div class="inner-info-content">
                        @can('Quản lý tài khoản-list')
                        <div class="ql_tk">
                            <a href="{{route('users.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/qltaikhoan.png"></a>
                            <span>QL Tài khoản</span>
                        </div>
                        @endcan
                        @can('Quản lý quyền-list')
                        <div class="ql_tk">
                            <a href="{{route('roles.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/qltaikhoan.png"></a>
                            <span>QL Quyền hạn</span>
                        </div>
                        @endcan
                        @can('Quản lý phòng-list')
                        <div class="ql_tk">
                            <a href="{{route('rooms.create')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/qlphong.png"></a>
                            <span>QL Phòng</span>
                        </div>
                        @endcan
                        @can('Quản lý thông tin chung-Thông tin cơ sở')
                        <div class="ql_tk tl_chung">
                            <ul>
                                <li>
                                    <a href="{{route('options.index')}}"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/ttcoso.png"></a>
                                    <span>TT Cơ sở</span>
                                </li>
                            </ul>
                            <span class="text_tlc">Thiết lập chung</span>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="info-content @if(!empty($menuHelp)) active  @endif">
                    <div class="inner-info-content">
                        <div class="ql_tk tl_chung">
                            <ul>
                                <li>
                                    <a href="#"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/huongdan01.png"></a>
                                    <span>Hướng dẫn</span>
                                </li>
                                <li>
                                    <a class="contact"><img class="image-svg" alt="" src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/lienhe.png"></a>
                                    <span>Liên hệ</span>
                                </li>
                            </ul>
                            <span class="text_tlc">Thông tin sử dụng</span>
                        </div>
                        <div class="ql_tk tl_chung">
                            <ul>
                                <li>
                                    <a href="https://start.teamviewer.com/device/authorization/password/mode/control">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve" id="svg-replaced-38" class="image-svg replaced-svg svg-replaced-38">
                                            <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon</metadata>
                                            <g>
                                                <g>
                                                    <path d="M610.5,492.5c-11.8-7.9-26.2-14.7-42.9-20.2c-16.5-5.4-35.1-10.5-55.5-14.9c-16-3.8-27.7-6.8-34.7-8.7c-6.8-1.9-13.6-4.6-20.2-8.1c-6.4-3.3-11.4-7.2-15-11.7c-3.4-4.2-5-9.1-5-15c0-9.6,5.1-17.7,15.5-24.7c10.9-7.3,25.5-11,43.5-11c19.4,0,33.5,3.3,41.9,10c8.7,6.8,16.3,16.4,22.5,28.7c5.4,9.6,10.3,16.2,15,20.5c5.1,4.6,12.3,6.9,21.6,6.9c10.2,0,18.9-3.7,25.8-11.1c6.8-7.3,10.3-15.7,10.3-24.9c0-9.6-2.6-19.5-7.8-29.5c-5.2-9.8-13.4-19.3-24.4-28.2c-10.9-8.8-24.9-16-41.4-21.3c-16.4-5.3-36.1-7.9-58.5-7.9c-28,0-52.8,4-73.6,11.9c-21.1,8-37.5,19.7-48.7,34.8c-11.3,15.2-17,32.7-17,52.2c0,20.4,5.5,37.9,16.2,51.7c10.6,13.7,25.1,24.6,43.1,32.5c17.6,7.7,39.7,14.5,65.7,20.2c19.1,4.1,34.6,8.1,46,11.7c10.9,3.5,19.9,8.6,26.8,15.2c6.5,6.3,9.7,14.3,9.7,24.5c0,12.9-6.1,23.4-18.6,32.2c-12.8,9-29.8,13.5-50.5,13.5c-15.1,0-27.3-2.3-36.4-6.7c-9-4.4-16.1-10-21-16.7c-5.1-7-10-15.8-14.4-26.3c-4-9.6-8.9-17.1-14.7-22.1c-6-5.3-13.5-7.9-22.1-7.9c-10.5,0-19.3,3.4-26.2,10c-6.9,6.7-10.5,14.9-10.5,24.4c0,15.1,5.4,30.8,16.1,46.6c10.6,15.7,24.4,28.3,41.3,37.7c23.6,12.9,53.8,19.4,89.8,19.4c30,0,56.4-4.8,78.4-14.2c22.2-9.5,39.4-22.9,51-39.8c11.6-17,17.6-36.4,17.6-57.6c0-17.8-3.4-33.1-10.2-45.5C632,510.8,622.5,500.5,610.5,492.5z M500,10C229.4,10,10,229.4,10,500c0,270.6,219.4,490,490,490c270.6,0,490-219.4,490-490C990,229.4,770.6,10,500,10z M617.4,774.4c-24.9,0-48.3-6.5-68.8-17.8c-14.9,2.8-30.2,4.3-45.9,4.3c-138.5,0-250.8-115.6-250.8-258.1c0-17.8,1.8-35.1,5.1-51.9c-12.7-22.2-20-48.1-20-75.7c0-82.7,65.1-149.7,145.5-149.7c28.5,0,55,8.4,77.4,23c13.9-2.5,28.3-3.8,42.9-3.8c138.5,0,250.8,115.6,250.8,258.1c0,19-2,37.5-5.8,55.4c9.7,20,15.1,42.6,15.1,66.5C762.9,707.4,697.8,774.4,617.4,774.4z"></path>
                                                </g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                            </g>
                                        </svg>
                                    </a>
                                    <span>Teamviewer</span>
                                </li>
                                <li>
                                    <a href="https://go.anydesk.com/">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="144px" height="144px" id="svg-replaced-39" class="image-svg replaced-svg svg-replaced-39">
                                            <path fill="#bdbdbd" d="M18,8c0.494,0,0.958,0.192,1.307,0.542l14.151,14.151c0.721,0.721,0.721,1.894,0,2.614 L19.307,39.459C18.958,39.808,18.494,40,18,40c-0.494,0-0.958-0.192-1.307-0.541L2.541,25.307c-0.721-0.721-0.721-1.894,0-2.614 L16.693,8.542C17.042,8.192,17.506,8,18,8 M18,6c-0.985,0-1.97,0.376-2.721,1.127L1.127,21.279c-1.503,1.503-1.503,3.939,0,5.443 l14.151,14.151C16.03,41.624,17.015,42,18,42s1.97-0.376,2.721-1.127l14.151-14.151c1.503-1.503,1.503-3.939,0-5.443L20.721,7.127 C19.97,6.376,18.985,6,18,6L18,6z"></path>
                                            <path fill="#d32f2f" d="M46.873,21.279c1.503,1.503,1.503,3.939,0,5.443L32.721,40.873c-1.503,1.503-3.939,1.503-5.443,0 L13.127,26.721c-1.503-1.503-1.503-3.94,0-5.443L27.279,7.127c1.503-1.503,3.939-1.503,5.443,0L46.873,21.279z"></path>
                                        </svg>
                                    </a>
                                    <span>Anydeks</span>
                                </li>
                            </ul>
                            <span class="text_tlc">Hỗ trợ từ xa</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /main-navigation -->
</header>
@endif