@extends('layouts.app')

@section('content')
    <div class="wrap-main">
        <div class="container">
            <div class="wrap-login">
                <div class="top-login">
                    <h3>Đăng Nhập</h3>
                </div>
                <div class="bottom-login">
                    <div class="thumbnail">
                        <img class="" alt=""
                             src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/thumbnail-login.png">
                    </div>
                    <div class="right-form">
                        <form method="POST" action="{{ route('login') }}"  id="form-login">
                            @csrf
                            <div class="form-group">
                                <label>Tài khoản</label>
                                <input id="email" type="email" class="form-control  form-control-sm @error('email') is-invalid @enderror" name="email" placeholder="Tên đăng nhập" value="{{ old('email') }}" required autocomplete="off" autofocus>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input id="password" type="password" class="form-control  form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="off"  placeholder="Mật khẩu">
                                <div class="in-form-group">
                                    <input class="form-check-input" type="checkbox" name="remember" id="luumatkhau" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="luumatkhau">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <input type="submit" value="Đăng nhập" class="form-submit">
                            @if (Route::has('password.request'))
                                <a class="btn btn-sm btn-link" href="{{ route('password.request') }}">
                                    {{ __('Lấy lại mật khẩu') }}
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="psnote">
                    <p>- Vui lòng kiểm tra Capslock, Unikey, Vietkey... trước khi đăng nhập</p>
                    <div class="choose-sql">
                        <div style="display:none">
                            <div id="data">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                        </div>
                    </div>
                </div>
                <div class="help-box">
                    <p>Chương trình hỗ trợ từ xa :</p>
                    <div class="inner-icon">
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" x="0px" y="0px" viewBox="0 0 1000 1000"
                                 enable-background="new 0 0 1000 1000" xml:space="preserve" id="svg-replaced-40"
                                 class="image-svg replaced-svg svg-replaced-40">
<metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon</metadata>
                                <g>
                                    <g>
                                        <path
                                            d="M610.5,492.5c-11.8-7.9-26.2-14.7-42.9-20.2c-16.5-5.4-35.1-10.5-55.5-14.9c-16-3.8-27.7-6.8-34.7-8.7c-6.8-1.9-13.6-4.6-20.2-8.1c-6.4-3.3-11.4-7.2-15-11.7c-3.4-4.2-5-9.1-5-15c0-9.6,5.1-17.7,15.5-24.7c10.9-7.3,25.5-11,43.5-11c19.4,0,33.5,3.3,41.9,10c8.7,6.8,16.3,16.4,22.5,28.7c5.4,9.6,10.3,16.2,15,20.5c5.1,4.6,12.3,6.9,21.6,6.9c10.2,0,18.9-3.7,25.8-11.1c6.8-7.3,10.3-15.7,10.3-24.9c0-9.6-2.6-19.5-7.8-29.5c-5.2-9.8-13.4-19.3-24.4-28.2c-10.9-8.8-24.9-16-41.4-21.3c-16.4-5.3-36.1-7.9-58.5-7.9c-28,0-52.8,4-73.6,11.9c-21.1,8-37.5,19.7-48.7,34.8c-11.3,15.2-17,32.7-17,52.2c0,20.4,5.5,37.9,16.2,51.7c10.6,13.7,25.1,24.6,43.1,32.5c17.6,7.7,39.7,14.5,65.7,20.2c19.1,4.1,34.6,8.1,46,11.7c10.9,3.5,19.9,8.6,26.8,15.2c6.5,6.3,9.7,14.3,9.7,24.5c0,12.9-6.1,23.4-18.6,32.2c-12.8,9-29.8,13.5-50.5,13.5c-15.1,0-27.3-2.3-36.4-6.7c-9-4.4-16.1-10-21-16.7c-5.1-7-10-15.8-14.4-26.3c-4-9.6-8.9-17.1-14.7-22.1c-6-5.3-13.5-7.9-22.1-7.9c-10.5,0-19.3,3.4-26.2,10c-6.9,6.7-10.5,14.9-10.5,24.4c0,15.1,5.4,30.8,16.1,46.6c10.6,15.7,24.4,28.3,41.3,37.7c23.6,12.9,53.8,19.4,89.8,19.4c30,0,56.4-4.8,78.4-14.2c22.2-9.5,39.4-22.9,51-39.8c11.6-17,17.6-36.4,17.6-57.6c0-17.8-3.4-33.1-10.2-45.5C632,510.8,622.5,500.5,610.5,492.5z M500,10C229.4,10,10,229.4,10,500c0,270.6,219.4,490,490,490c270.6,0,490-219.4,490-490C990,229.4,770.6,10,500,10z M617.4,774.4c-24.9,0-48.3-6.5-68.8-17.8c-14.9,2.8-30.2,4.3-45.9,4.3c-138.5,0-250.8-115.6-250.8-258.1c0-17.8,1.8-35.1,5.1-51.9c-12.7-22.2-20-48.1-20-75.7c0-82.7,65.1-149.7,145.5-149.7c28.5,0,55,8.4,77.4,23c13.9-2.5,28.3-3.8,42.9-3.8c138.5,0,250.8,115.6,250.8,258.1c0,19-2,37.5-5.8,55.4c9.7,20,15.1,42.6,15.1,66.5C762.9,707.4,697.8,774.4,617.4,774.4z"></path>
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
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="144px" height="144px"
                                 id="svg-replaced-41" class="image-svg replaced-svg svg-replaced-41">
                                <path fill="#bdbdbd"
                                      d="M18,8c0.494,0,0.958,0.192,1.307,0.542l14.151,14.151c0.721,0.721,0.721,1.894,0,2.614 L19.307,39.459C18.958,39.808,18.494,40,18,40c-0.494,0-0.958-0.192-1.307-0.541L2.541,25.307c-0.721-0.721-0.721-1.894,0-2.614 L16.693,8.542C17.042,8.192,17.506,8,18,8 M18,6c-0.985,0-1.97,0.376-2.721,1.127L1.127,21.279c-1.503,1.503-1.503,3.939,0,5.443 l14.151,14.151C16.03,41.624,17.015,42,18,42s1.97-0.376,2.721-1.127l14.151-14.151c1.503-1.503,1.503-3.939,0-5.443L20.721,7.127 C19.97,6.376,18.985,6,18,6L18,6z"></path>
                                <path fill="#d32f2f"
                                      d="M46.873,21.279c1.503,1.503,1.503,3.939,0,5.443L32.721,40.873c-1.503,1.503-3.939,1.503-5.443,0 L13.127,26.721c-1.503-1.503-1.503-3.94,0-5.443L27.279,7.127c1.503-1.503,3.939-1.503,5.443,0L46.873,21.279z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
