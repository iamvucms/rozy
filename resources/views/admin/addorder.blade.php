<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/cat.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/order.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="../../assetsAdmin/ckeditor/ckeditor.js"></script>
    <title>Admin::Orders::Add</title>
</head>

<body>
    <div class="vucms">
        <div class="menubar">
            <div class="menuname">
                <span class="namehiden">
                    VUCMS SYSTEM
                </span><button id="propbar"><i class="fas fa-bars"></i></button>
            </div>
            <div class="options">
                <div class="top">
                    <div class="me">
                        <img src="../../assetsAdmin/img/avt.jpg" alt="">
                        <div class="meme">
                            <p class="online"><span class="pointonline"></span>
                                Online</p>
                            <p class="myname">I am VuCms</p>
                        </div>
                    </div>
                    <div class="searchbox">
                        <form action="#">
                            <input type="search" placeholder="Tìm Kiếm">
                        </form>
                    </div>
                </div>
                <div class="navigation">
                    <div class="navtitle">
                        Khu vực chính
                    </div>
                    <div class="navitems">
                        <ul class="items">
                            <li class="lv1"><a href="index.html">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span class="navtext">Bảng điều
                                        khiển</span>
                                </a>
                            </li>
                            <li class="lv1"><i class="fas fa-chart-bar"></i>
                                <span class="navtext">Quản lí</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="categories.html">Danh mục</a></li>
                                    <li class="lv2"><a href="product.html">Sản phẩm</a></li>
                                    <li class="lv2"><a href="vote.html">Đánh giá</a></li>
                                    <li class="lv2"><a href="supplier.html">Nhà cung cấp</a></li>
                                    <li class="lv2"><a href="file.html">Files</a></li>
                                </ul>
                            </li>

                            <!-- <li class="lv1"><i class="fas fa-layer-group"></i>
                                                                                <span class="navtext">Gian hàng</span><i
                                                                                          class="fas fa-angle-right"></i>
                                                                                          <ul class="lv2items">
                                                                                                    <li class="lv2">Bố cục</li>
                                                                                                    <li class="lv2">Banner</li>
                                                                                                    <li class="lv2">Công cụ SEO</li>
                                                                                                    <li class="lv2">Subcategory 4</li>
                                                                                                    <li class="lv2">Subcategory 5</li>
                                                                                          </ul>
                                                                      </li> -->
                            <li class="lv1"><i class="fas fa-users"></i> <span class="navtext">Khách hàng</span><i
                                    class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="customer.html">Danh sách</a></li>
                                    <li class="lv2"><a href="customer_group.html">Nhóm</a></li>
                                    <li class="lv2"><a href="customer_ban.html">Danh sách bị cấm</a></li>
                                </ul>
                            </li>
                            <li class="lv1"><i class="fas fa-shopping-cart"></i>
                                <span class="navtext">Bán hàng</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="order.html">Đơn hàng</a></li>
                                    <li class="lv2"><a href="coupon.html">Coupon</a></li>
                                </ul>
                            </li>
                            <li class="lv1"><i class="fas fa-desktop"></i>
                                <span class="navtext">Thiết Kế</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="layout.html">Bố cục</a></li>
                                    <li class="lv2"><a href="banner.html">Banner</a></li>
                                    <li class="lv2"><a href="seotool.html">Công cụ SEO</a></li>
                                </ul>
                            </li>
                            <li class="lv1"><i class="fas fa-list-ul"></i>
                                <span class="navtext">Tiện ích</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2">Biên soạn</li>
                                    <li class="lv2">Subcategory 2</li>
                                    <li class="lv2">Subcategory 3</li>
                                    <li class="lv2">Subcategory 4</li>
                                    <li class="lv2">Subcategory 5</li>
                                </ul>
                            </li>
                            <li class="lv1"><a href="setting.html"><i class="fas fa-cogs"></i> <span class="navtext">Cài
                                        đặt
                                        chung</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="top">
                <ul class="listtop">
                    <li><i class="far fa-bell"></i> <span class="toptext">Thông báo</span>
                    </li>
                    <li><i class="far fa-envelope"></i> <span class="toptext">Tin
                            nhắn</span></li>
                    <li class="topprofile">
                        <img src="../../assetsAdmin/img/avt.jpg" alt="">
                        <span class="nameprofile"><span class="toptext">VuCms</span>
                            <i class="fas fa-angle-down"></i>

                        </span>
                        <ul>
                            <li><i class="fas fa-cogs"></i> <a href="#">&nbsp;
                                    Cài Đặt</a></li>
                            <li><i class="fas fa-id-card-alt"></i> <a href="#">&nbsp; Trang Cá
                                    Nhân</a></li>
                            <li><i class="far fa-envelope"> </i> <a href="#">&nbsp; Tin nhắn của
                                    bạn</a></li>
                            <li><i class="far fa-bell"></i> <a href="#">&nbsp;
                                    Tất cả thông bá</a>o</li>
                            <li><i class="fas fa-sign-out-alt"></i> <a href="#">&nbsp; Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="bottom">
                <div class="headtitle">
                    <p>ĐƠN HÀNG</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Đơn Hàng</a></span></li>

                        </ul>
                    </div>

                </div>
                <div class="catlist" id="add">
                    <p class="cattitle">
                        <i class="fas fa-pen-nib"> </i> Thêm Đơn Hàng
                    </p>
                    <div class="tabcat">
                        <div class="panel">
                            <ul>
                                <li data-id="tab1" class="active">1. Chi tiết đơn hàng</li>
                                <li data-id="tab2">2. Sản Phẩm</li>
                                <li data-id="tab3">3. Thanh Toán</li>
                                <li data-id="tab4">4. Phương Thức Vận Chuyển</li>
                                <li data-id="tab5">5. Hoàn Thành</li>
                            </ul>
                        </div>
                        <table id="tab1">

                            <tr>
                                <td>Cửa Hàng</td>
                                <td><input type="text" placeholder="Tên Cửa Hàng" list="liststore" value="">
                                    <datalist id="liststore">
                                        <option value="ROZY">
                                        <option value="Internet Explorer">
                                        <option value="Firefox">
                                        <option value="Chrome">
                                        <option value="Opera">
                                        <option value="Safari">
                                    </datalist>
                                </td>
                            </tr>

                            <tr>
                                <td>Họ Tên Khách Hàng</td>
                                <td><input type="text" placeholder="Họ Tên Khách Hàng"></td>
                            </tr>
                            <tr>
                                <td>Nhóm Khách Hàng</td>
                                <td>
                                    <select name="aa" id="">
                                        <option value="--">Khách Hàng Mới</option>
                                        <option value="like">Khách Hàng Tiềm Năng</option>
                                        <option value="president">Khách Hàng Thân Thiết</option>
                                        <option value="example">Khách Hàng Lâu Năm</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="text" placeholder="Email Khách Hàng"></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td><input type="text" placeholder="Số điện thoại khách hàng"></td>
                            </tr>
                            <tr>
                                <td>Trạng Thái</td>
                                <td>
                                    <select name="aa" id="">
                                        <option value="--">Chờ Xử lý</option>
                                        <option value="like">Đã Hoàn Thành</option>
                                        <option value="president">Bị hủy</option>
                                        <option value="example">Trả Lại</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button class="addcat" style="width:auto;padding:0px 7px;">Tiếp tục <i
                                            class="fas fa-arrow-right"></i></button></td>
                            </tr>
                        </table>
                        <table id="tab2" border="1">
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Số lượng</th>
                                <th>Tùy Chọn</th>
                                <th>Đơn Giá</th>
                                <th>Tổng Cộng</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="tab2sl">0</td>
                                <td td="tab2md"></td>
                                <td id="tab2up">0</td>
                                <td id="tab2tt">0</td>
                                <td><button id="addsale">+</button></td>
                            </tr>
                            <datalist id="listproduct">
                                <option value="SamSung A30">
                                <option value="Iphone X">
                                <option value="Apple Watch">
                                <option value="Áo Khoác Jean N12">
                                <option value="Mô Hình Lắp Ráp S58">
                                <option value="Tủ lạnh panasonic nr-bl267vsv1">
                            </datalist>
                        </table>
                        <table id="tab3">
                            <div>
                                <tr>
                                    <td>Người Thanh Toán</td>
                                    <td><input type="text" placeholder="Người Thanh Toán"></td>
                                </tr>
                                <tr>
                                    <td>Mã Số Thuế</td>
                                    <td><input type="text" placeholder="Mã Số Thuế"></td>
                                </tr>

                                <tr>
                                    <td>Phương Thức</td>
                                    <td> <select name="aa" id="">
                                            <option value="--">Thanh Toán Khi Nhận Hàng</option>
                                            <option value="like">Thanh Toán Trực Tiếp</option>
                                            <option value="president">Thanh Toán Online</option>
                                            <option value="example" selected>Thanh Toán Visa/MasterCard</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mã Thẻ</td>
                                    <td><input type="text" placeholder="Mã Thẻ"></td>
                                </tr>
                                <tr>
                                    <td>Ngày Hết Hạn</td>
                                    <td><input type="text" placeholder="MM/YY"></td>
                                </tr>
                                <tr>
                                    <td>Mã Bảo Mật</td>
                                    <td><input type="text" placeholder="CVV/CCV"></td>
                                </tr>
                        </table>

                        <table id="tab4">

                            <tr>
                                <td>Số Nhà</td>
                                <td><input type="text" placeholder="Số Nhà"></td>
                            </tr>
                            <tr>
                                <td> Tên Đường</td>
                                <td><input type="text" placeholder="Tên Đường"></td>
                            </tr>
                            <tr>
                                <td>Quận/Huyện</td>
                                <td><input type="text" placeholder="Quận/Huyện"></td>
                            </tr>
                            <tr>
                                <td>Tỉnh/Thành Phố</td>
                                <td><input type="text" placeholder="Tỉnh/Thành Phố"></td>
                            </tr>
                            <tr>
                                <td>Phương thức giao hàng</td>
                                <td>
                                    <select name="aa" id="">
                                        <option value="--">Giao Hàng Tiết Kiệm</option>
                                        <option value="like">GIao Hàng Tiêu Chuẩn</option>
                                        <option value="">Giao Hàng Hỏa Tốc</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Họ Tên Người Nhận</td>
                                <td><input type="text" placeholder="Họ Tên Người Nhận"></td>
                            </tr>
                            <tr>
                                <td>Số Điện Thoại người nhận</td>
                                <td><input type="text" placeholder="Số Điện Thoại người nhận"></td>
                            </tr>
                            <tr>
                                <td>Chú thích</td>
                                <td><textarea type="text" placeholder="Chú thích " style="line-height:normal"
                                        rows="5"></textarea></td>
                            </tr>
                        </table>
                        <table id="tab5" border="1">
                            <tr>
                                <th>STT</th>
                                <th>Tên khách hàng</th>
                                <th>Mã số VAT</th>
                                <th>Giá trị</th>
                                <th>Trạng thái</th>
                                <th>Thời Gian khởi tạo</th>
                                <th>Thời Gian cập nhật </th>
                                <th>Thao tác</th>
                            </tr>
                            <tr>
                                <td style="font-weight: normal;text-align: left!important;">10277</td>
                                <td><a href="#customer">Cecilia Hicks</a></td>
                                <td>VAT17489</td>
                                <td>3,800,000 VND</td>
                                <td>
                                    <div class="tabstt">
                                        <span class="point" id="pen"></span>
                                        <span class="stttext">Chờ Xử Lý</span>
                                    </div>
                                </td>
                                <td>6/21/2058</td>
                                <td>1/18/2045</td>
                                <td>
                                    <div class="lasttd">
                                        <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                        <li id="showoption"><i class="fas fa-angle-down"></i>
                                            <ul>
                                                <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                <li><i class="far fa-edit"></i> Cập Nhật</li>
                                                <li><a href="print.html" style="color:#555" target="__blank"><i
                                                            class="fas fa-print"></i> In đơn hàng</a></li>
                                                <li><a href="print.html" style="color:#555" target="__blank"><i
                                                            class="far fa-file-powerpoint"></i> In đơn vận chuyển</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../assetsAdmin/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>

</body>

</html>