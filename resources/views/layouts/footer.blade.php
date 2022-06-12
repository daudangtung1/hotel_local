<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
        <ul class="list-item">
            <li>
                <p>Sẵn sàng: 15</p>
            </li>
            <li>
                <p>Có khách: 0</p>
            </li>
            <li>
                <p>Khách ra ngoài: 0</p>
            </li>
            <li>
                <p>Bẩn: 0</p>
            </li>
            <li>
                <p>Đang dọn: 0</p>
            </li>
            <li>
                <p>Đang sửa: 0</p>
            </li>
            <li>
                <p><a data-fancybox="datphongnhanh" data-src="#modal" href="javascript:;" class="">Đặt phòng: 0</a>
                </p>
            </li>
        </ul>
    </div>
    <div id="" class="container">
        <div id="modal" class="info-room-dp dat-phong-nhanh" style="display:none;">
            <div class="top-bar"><h3>Đặt phòng nhanh</h3></div>
            <form action="/">
                <div class="content-room-dp">
                    <div class="col-left">
                        <div class="box-time">
                            <p>Thời gian đặt phòng</p>
                            <input id="datetimepicker1" type="text">
                            <p>Đến</p>
                            <input id="datetimepicker2" type="text">
                        </div>
                        <div class="checkbox-hd">
                            <input id="price_hd" type="checkbox" name="price_hd" value="price_hd" checked="">
                            <label for="price_hd"> Tính giá theo HĐ</label><br><br>
                            <input class="ktdp" type="button" value="Kiểm tra đặt phòng">
                        </div>
                        <div class="checkbox-hd checkbox-hd-show">
                            <input id="hienthiphisale" type="checkbox" name="hienthiphisale" value="price_hd"
                                   checked="">
                            <label for="hienthiphisale"> Hiển thị phí SALE</label><br>
                            <input id="hienthitenkhach" type="checkbox" name="hienthitenkhach" value="price_hd"
                                   checked="">
                            <label for="hienthitenkhach"> Hiển thị tên khách ở </label><br>
                            <input id="ghichu" type="checkbox" name="ghichu" value="price_hd" checked="">
                            <label for="ghichu"> Hiển thị ghi chú riêng</label><br>
                        </div>
                    </div>
                    <div class="col-right">
                        <div class="top-col-right">
                            <div class="left-top-col-right">
                                <div class="row-full">
                                    <div class="row50">
                                        <label for="tendoan"> Tên đoàn</label>
                                        <select name="ten_doan" id="tendoan">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select><br>
                                    </div>
                                    <div class="row50">
                                        <label for="mabooking"> Mã booking</label>
                                        <input id="mabooking" type="text" name="ma_booking" value=""><br>
                                    </div>
                                </div>
                                <div class="row-full">
                                    <div class="row50">
                                        <label for="nguon"> Nguồn</label>
                                        <select name="nguon" id="nguon">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select><br>
                                    </div>
                                    <div class="row50">
                                        <label for="mausac"> Màu sắc</label>
                                        <input type="color" class="color01" id="mausac" name="mausac"
                                               value="#e66465"><br>
                                    </div>
                                </div>
                                <div class="row-full">
                                    <div class="row50">
                                        <label for="datcoc"> Đặt cọc</label>
                                        <input id="datcoc" type="text" name="dat_coc" value=""><br>
                                    </div>
                                    <div class="row50">
                                        <label for="tencty"> Tên Cty</label>
                                        <input id="tencty" type="text" name="ten_cty" value=""><br>
                                    </div>
                                </div>
                                <div class="row-full">
                                    <div class="row50">
                                        <label for="ttkhach"> TT Khách</label>
                                        <input id="ttkhach" type="text" name="tt_khach" value=""><br>
                                    </div>
                                    <div class="row50">
                                        <div class="wrap-tooltip">
                                            <input type="number" class="quantity1" name="songuoilon" min="1"
                                                   max="999">
                                            <span class="input-tooltip">Số người lớn</span>
                                        </div>
                                        <div class="wrap-tooltip">
                                            <input type="number" class="quantity1" name="sotreem" min="1" max="999">
                                            <span class="input-tooltip">Số trẻ em</span>
                                        </div>
                                        <div class="wrap-tooltip">
                                            <input type="number" class="quantity1" name="noi_bo" min="1" max="999">
                                            <span class="input-tooltip">Nội bộ</span>
                                        </div>
                                        <div class="wrap-tooltip">
                                            <input type="number" class="quantity1" name="giuong_phu" min="1"
                                                   max="999">
                                            <span class="input-tooltip">Giường phụ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-full">
                                    <div class="row50 row100">
                                        <label for="story"> Ghi chú</label>
                                        <textarea id="story" name="story" rows="5" cols="33"> </textarea> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="right-top-col-right">
                                <p>Thông tin người đặt</p>
                                <div class="inner-right-top-col-right">
                                    <div class="left">
                                        <div class="row100">
                                            <label for="tennguoidat"> Tên người đặt</label>
                                            <select name="ten_nguoi_dat" id="tennguoidat">
                                                <option value="volvo">Volvo</option>
                                                <option value="saab">Saab</option>
                                                <option value="mercedes">Mercedes</option>
                                                <option value="audi">Audi</option>
                                            </select><br>
                                        </div>
                                        <div class="row100">
                                            <label for="congty"> Công Ty</label>
                                            <input id="congty" type="text" name="cong_ty" value=""><br>
                                        </div>
                                        <div class="row100">
                                            <label for="sdt">Số ĐT</label>
                                            <input id="sdt" type="number" name="sdt" value=""><br>
                                        </div>
                                        <div class="row100">
                                            <label for="diachi">Địa chỉ</label>
                                            <input id="diachi" type="text" name="dia_chi" value=""><br>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <a data-fancybox="danhsachmakhachhang" data-src="#danhsachmakhachhang"
                                           class="" href="javascript:;"><img class="" alt=""
                                                                             src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/+.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-col-right" style="">
                            <div class="left">
                                <div class="inner">
                                    <p>Các loại phòng có thể cho thuê</p>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <th>Loại phòng</th>
                                            <th>Số phòng trống</th>
                                            <th>Chi phí dự kiến</th>
                                            <th>Số phòng đặt</th>
                                            <th>Giá 1 ngày</th>
                                            <th>Phí Sale</th>
                                            <th>Thực thu</th>
                                        </tr>
                                        <tr>
                                            <td>Phòng đơn</td>
                                            <td>9</td>
                                            <td>3.600</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Phòng đôi</td>
                                            <td>6</td>
                                            <td>6000</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="total">
                                    <div class="row100">
                                        <label> Tổng số phòng trống</label>
                                        <span>15</span><br> <br>
                                    </div>
                                    <div class="row100">
                                        <label> Tổng số phòng đặt</label>
                                        <span>0</span><br> <br>
                                    </div>
                                    <div class="row100">
                                        <label> Tổng tiền dự kiến</label>
                                        <span>đ</span><br> <br>
                                    </div>
                                    <div class="row100">
                                        <label> Tổng tiền hoa hồng</label>
                                        <span>đ</span><br> <br>
                                    </div>
                                    <div class="row100">
                                        <label> Tổng tiền thực thu</label>
                                        <span>đ</span><br> <br>
                                    </div>
                                </div>


                            </div>
                            <div class="right">
                                <div class="inner">
                                    <p>Các phòng có thể thuê</p>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <th>Tên <br>Phòng</th>
                                            <th>Chi phí dự kiến</th>
                                            <th>Chọn đặt</th>
                                            <th>Giá 1 ngày</th>
                                            <th>Phí Sale</th>
                                            <th>Thực thu</th>
                                            <th>Tên khách</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                        <tr>
                                            <td>Phòng 101</td>
                                            <td>3.600</td>
                                            <td><input type="checkbox" id="chondat" name="chondat" value=""></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Phòng 101</td>
                                            <td>3.600</td>
                                            <td><input type="checkbox" id="chondat" name="chondat" value=""></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Phòng 101</td>
                                            <td>3.600</td>
                                            <td><input type="checkbox" id="chondat" name="chondat" value=""></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Phòng 101</td>
                                            <td>3.600</td>
                                            <td><input type="checkbox" id="chondat" name="chondat" value=""></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="total">
                                    <div class="row100">
                                        <label> Số phòng</label>
                                        <span>0</span><br> <br>
                                    </div>

                                    <div class="row100">
                                        <label for="tongtiendukien2"> Tổng tiền dự kiến</label>
                                        <span>0</span><br> <br>
                                    </div>
                                    <div class="row100">
                                        <label for="tongtienhoahong2"> Tổng tiền hoa hồng</label>
                                        <span>đ</span><br> <br>
                                    </div>
                                    <div class="row100">
                                        <label for="tongtienthucthu2"> Tổng tiền thực thu</label>
                                        <span>đ</span><br> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-sb">
                            <input class="sb" type="submit" value="Lưu và thoát">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="container">
        <div id="danhsachmakhachhang" style="display:none;">
            <form action="/">
                <h3>Danh sách khách hàng</h3>
                <div class="wrap-ds-ma-kh">

                    <div class="dsmkh-left">
                        <div class="inner-dsmkh-left">
                            <div class="left">
                                <div class="row50">
                                    <label for="ma-kh1">Mã KH</label>
                                    <input id="ma-kh1" type="number" class="quantity1" name="makh1" min="1"
                                           max="999">
                                </div>
                                <div class="row50">
                                    <label for="sogiayto">Số giấy tờ</label>
                                    <input id="sogiayto" type="text" class="quantity1" name="so_giay_to">
                                </div>
                                <div class="row50">
                                    <label for="hoten">Họ tên</label>
                                    <input id="hoten" type="text" class="quantity1" name="ho_ten">
                                </div>
                                <div class="row50">
                                    <label for="dienthoai">Điện thoại</label>
                                    <input id="dienthoai" type="number" class="quantity1" name="dien_thoai">
                                </div>
                                <div class="row50">
                                    <label for="diachi">Địa chỉ</label>
                                    <input id="diachi" type="text" class="quantity1" name="dia_chi">
                                </div>
                                <div class="row50">
                                    <label for="nghenghiepcty">N.Nghiệp_Cty</label>
                                    <input id="nghenghiepcty" type="text" class="quantity1" name="nghe_nghiep_cty">
                                </div>
                                <div class="row50">
                                    <label for="ngaycapsgt">Ngày cấp SGT</label>
                                    <input id="ngaycapsgt" type="text" class="quantity1" name="ngay_cap_sgt">
                                </div>
                                <div class="row50">
                                    <label for="ngaysinh">Ngày sinh</label>
                                    <input id="ngaysinh" type="text" class="quantity1" name="ngay_sinh">
                                </div>
                                <div class="row50">
                                    <label for="email1">Email</label>
                                    <input id="email1" type="email" class="quantity1" name="email">
                                </div>
                                <div class="row50">
                                    <label for="gioitinh">Giới tính</label>
                                    <select name="gioi_tinh" id="gioitinh">
                                        <option value="nam">Nam</option>
                                        <option value="nu">Nữ</option>
                                    </select><br>
                                </div>
                                <div class="row50">
                                    <label for="nhomkhach1"> Nhóm khách</label>
                                    <select name="nhom_khach1" id="nhomkhach1">
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select><br>
                                    <a data-fancybox="quanlynhomkhach" data-src="#quanlynhomkhach" class=""
                                       href="javascript:;"><img class="" alt=""
                                                                src="https://anovavn.com/wpdemo/Hotel/wp-content/themes/Hotel/assets/images/+.png"></a>
                                </div>
                            </div>
                            <div class="right">
                                <div class="row50">
                                    <label for="ghichukh">Ghi chú KH</label>
                                    <textarea id="ghichukh" name="ghichu_kh" rows="5" cols="33"> </textarea> <br>
                                </div>
                                <div class="row50">
                                    <label for="quoctich"> Quốc tịch</label>
                                    <select name="quoctich" id="quoctich">
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select><br>
                                </div>
                                <div class="row50">
                                    <label for="sovisa">Số visa</label>
                                    <input id="sovisa" type="number" class="quantity1" name="so_visa">
                                </div>
                                <div class="row50">
                                    <label for="thoihanvisa">Thời hạn visa</label>
                                    <input id="thoihanvisa" type="text" class="quantity1" name="thoi_han_visa">
                                </div>
                                <div class="row50">
                                    <label for="nguoitnhan">Người T.Nhận</label>
                                    <input id="nguoitnhan" type="text" class="quantity1" name="nguoi_t_nhan">
                                </div>
                                <div class="row50">
                                    <label for="tamtrutu">Tạm trú từ</label>
                                    <input id="tamtrutu" type="text" class="quantity1" name="tam_tru_tu">
                                </div>
                                <div class="row50">
                                    <label for="tamtruden">Tạm trú đến</label>
                                    <input id="tamtruden" type="text" class="quantity1" name="tam_tru_den">
                                </div>
                                <div class="checkbox-show">
                                    <input id="lakhachhang" type="checkbox" name="la_khach_hang" value=""
                                           checked="">
                                    <label for="lakhachhang"> Là khách hàng</label><br>

                                    <input id="lanhacungcap" type="checkbox" name="lanhacungcap" value="">
                                    <label for="lanhacungcap"> Là nhà cũng cấp </label><br>

                                    <input id="ladailydulich" type="checkbox" name="la_dai_ly_du_lich" value="">
                                    <label for="ladailydulich"> Là đại lý du lịch</label><br>
                                </div>
                            </div>
                        </div>
                        <input type="button" value="Thêm">
                        <input type="button" value="Sửa">
                        <input type="button" value="Gộp khách">
                    </div>
                    <div class="dsmkh-right">
                        <div class="top-dsmkh-right">
                            <div class="row50">
                                <label for="quoctich"> Quốc tịch</label>
                                <select name="quoctich" id="quoctich">
                                    <option value="volvo">Volvo</option>
                                    <option value="saab">Saab</option>
                                    <option value="mercedes">Mercedes</option>
                                    <option value="audi">Audi</option>
                                </select><br>
                            </div>
                        </div>
                        <div class="bottom-dsmkh-right">
                            <table>
                                <tbody>
                                <tr>
                                    <th>Xóa</th>
                                    <th>Mã khách</th>
                                    <th>Số giấy tờ</th>
                                    <th>Họ tên</th>
                                    <th>Giá 1 ngày</th>
                                    <th>Điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Nghề nghiệp</th>
                                    <th>Ngày cấp giấy tờ</th>
                                    <th>Ngày sinh</th>
                                    <th>Hộp thư</th>
                                    <th>Giới tính</th>
                                    <th>Ghi chú</th>
                                    <th>Quốc tịch</th>
                                    <th>Số visa</th>
                                </tr>
                                <tr>
                                    <td><input class="remove" type="button" value="Xóa"></td>
                                    <td><span>1</span></td>
                                    <td><span>17</span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span>11/01/2021</span></td>
                                    <td><span>11/01/2021</span></td>
                                    <td><span> </span></td>
                                    <td><span>Nam</span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                </tr>
                                <tr>
                                    <td><input class="remove" type="button" value="Xóa"></td>
                                    <td><span>1</span></td>
                                    <td><span>17</span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span>11/01/2021</span></td>
                                    <td><span>11/01/2021</span></td>
                                    <td><span> </span></td>
                                    <td><span>Nam</span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                    <td><span></span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div id="quanlynhomkhach" style="display:none;">
            <h3>Quản lý nhóm khách</h3>
            <form action="/">
                <div class="inner-quanlynhomkhach">
                    <div class="left">
                        <table>
                            <tbody>
                            <tr>
                                <th>Xóa</th>
                                <th>Mã nhóm khách</th>
                                <th>Tên nhóm khách</th>
                                <th>Mã giảm giá</th>
                            </tr>
                            <tr>
                                <td><input class="remove" type="button" value="Xóa"></td>
                                <td><span>1</span></td>
                                <td><span>17</span></td>
                                <td><span></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="right">
                        <div class="row50">
                            <label for="manhomkhach1"> Mã Nhóm khách</label>
                            <select name="ma_nhom_khach1" id="manhomkhach1">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select><br>
                        </div>
                        <div class="row50">
                            <label for="tennhomkhach1"> Tên Nhóm khách</label>
                            <input id="tennhomkhach1" type="text" name="ten_nhom_khach1" value=""> <br>
                        </div>
                        <div class="row50">
                            <label for="magiamgia1"> Mã giảm giá</label>
                            <select name="ma-giam-gia1" id="magiamgia1">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select><br>
                        </div>
                        <input type="button" value="lưu">
                        <input type="button" value="thoát">
                    </div>
                </div>
            </form>
        </div>
    </div>
</footer><!-- #colophon -->
