<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../../assetsAdmin/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="../../../assetsAdmin/css/index.css">
  <link rel="stylesheet" href="../../../assetsAdmin/css/cat.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="../../../assetsAdmin/css/chart.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script src="../../../assetsAdmin/ckeditor/ckeditor.js"></script>
  <title>Admin::Products::Add</title>
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
            <img src="../../../assetsAdmin/img/avt.jpg" alt="">
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
              <li class="lv1"><a href="index.html"> <i class="fas fa-tachometer-alt"></i> <span class="navtext">Bảng
                    điều khiển</span> </a> </li>
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
              <li class="lv1"><a href="setting.html"><i class="fas fa-cogs"></i> <span class="navtext">Cài đặt
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
            <img src="../../../assetsAdmin/img/avt.jpg" alt="">
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
          <p>SẢN PHẨM</p>
          <div class="breadcrumb">
            <ul>
              <li><span class="sub">Quản lí</span></li>
              <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
              <li><span class="main"><a href="{{url()->route('superProduct')}}">Sản Phẩm</a></span></li>

            </ul>
          </div>

        </div>
        <div class="catlist" id="add">
          <p class="cattitle">
            <i class="fas fa-pen-nib"> </i> Thêm Sản Phẩm
          </p>
          <div class="tabcat">
            <div class="panel">
              <ul>
                <li data-id="tab1" class="active">Chung</li>
                <li data-id="tab4">Thông Số Chi Tiết</li>
                <li data-id="tab3">Thông Số kĩ thuật</li>
                <li data-id="tab2">Mô tả & SEO</li>
                <li data-id="tab5">Khuyến Mãi</li>
                <li data-id="tab6">Hình ảnh</li>
              </ul>
            </div>
            <table id="tab1">

              <tr>
                <td>Tên sản phẩm</td>
                <td><input type="text" placeholder="Tên sản phẩm"></td>
              </tr>

              <tr>
                <td>Thẻ meta title</td>
                <td><input type="text" placeholder="Thẻ meta title"></td>
              </tr>

              <tr>
                <td>Danh mục</td>
                <td>
                  <select name="aa" id="">
                    <option value="--">--</option>
                    <option value="like">block</option>
                    <option value="president">concerned</option>
                    <option value="example">was</option>
                    <option value="why">laid</option>
                    <option value="ability">call</option>
                    <option value="noise">certain</option>
                    <option value="front">electricity</option>
                    <option value="fighting">supply</option>
                    <option value="potatoes">greatly</option>
                    <option value="running">loss</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Giá</td>
                <td><input type="number" value="0" min="0"></td>
              </tr>
              <tr>
                <td>Xu hướng</td>
                <td>
                  <select name="aa" id="">
                    <option value="potatoes">Bán chạy</option>
                    <option value="running">Phổ Biến</option>
                    <option value="potatoes">Vừa Ra Mắt</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Trạng thái</td>
                <td>
                  <select name="aa" id="">
                    <option value="potatoes">Đang Kinh Doanh</option>
                    <option value="running">Hết Hàng</option>
                    <option value="potatoes">Ngừng Kinh Doanh</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><button class="cancelcat">Hủy</button></td>
                <td><button class="addcat">Thêm</button></td>
              </tr>
            </table>
            <table id="tab2">

              <tr>
                <td>Thẻ Meta mô tả</td>
                <td><textarea type="text" placeholder="Thẻ Meta mô tả	"></textarea></td>
              </tr>
              <tr>
                <td>Thẻ Meta Keyword</td>
                <td><input type="text" placeholder="Thẻ Meta Keyword"></td>
              </tr>
              <tr>
                <td>Mô tả sản phẩm</td>
                <td><textarea name="" id="destext" style="width:100%" placeholder="Mô tả danh mục"></textarea></td>
              </tr>
              <tr>
                <td>Gắn thẻ</td>
                <td><input type="text" placeholder="Ví dụ: Samsung_A30,Iphone_x"></td>
              </tr>
              <tr>
                <td>SEO Từ khóa</td>
                <td><input type="text" placeholder="SEO Từ Khóa	"></td>
              </tr>
              <tr>
                <td>SEO Mô tả</td>
                <td><textarea name="" id="" style="width:100%" placeholder="SEO Mô tả"></textarea></td>
              </tr>
              <tr>
                <td>SEO URL</td>
                <td><input type="text" placeholder="Ví dụ: dien-lanh-dien-tu"></td>
              </tr>
            </table>
            <table id="tab3">
              <div>
                <tr>
                  <td>Độ dày</td>
                  <td><input type="text" placeholder="Độ dày"></td>
                </tr>
                <tr>
                  <td>Trọng lượng</td>
                  <td><input type="text" placeholder="Trọng lượng"></td>
                </tr>

                <tr>
                  <td>Chất liệu</td>
                  <td><input type="text" placeholder="Chất liệu"></td>
                </tr>
                <tr>
                  <td>Kích Thước</td>
                  <td><input type="text" placeholder="Kích Thước"></td>
                </tr>
                <tr>
                  <td><input type="text" placeholder="Tên trường"
                      style="text-align: right;padding-right: 5px;font-weight: bold;"></td>
                  <td style="padding-left: 25px!important;"><input type="text" placeholder="Giá trị"></td>
                  <td style="width:10%"><button id="addfield">+</button></td>
                </tr>
            </table>

            <table id="tab4">

              <tr>
                <td>Model</td>
                <td><input type="text" placeholder="Model"></td>
              </tr>
              <tr>
                <td> Thương hiệu</td>
                <td><input type="text" placeholder="Thương hiệu"></td>
              </tr>
              <tr>
                <td>SKU</td>
                <td><input type="text" placeholder="SKU"></td>
              </tr>
              <tr>
                <td>Số Lượng</td>
                <td><input type="number" min="1" value="1" placeholder="Số Lượng"></td>
              </tr>
              <tr>
                <td>Số Lượng Nhỏ nhất</td>
                <td><input type="number" min="1" value="1" placeholder="Số Lượng"></td>
              </tr>
              <tr>
                <td>Yêu cầu vận chuyển</td>
                <td>
                  <select name="aa" id="">
                    <option value="--">Có </option>
                    <option value="like">Không</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Thời gian chuẩn bị</td>
                <td>
                  <select name="aa" id="">
                    <option value="--">Ngay lập tức</option>
                    <option value="like">12h</option>
                    <option value="president">1 ngày</option>
                  </select>
                </td>
              </tr>

              <tr>
                <td>Sản xuất tại</td>
                <td><input type="text" placeholder="Sản xuất tại"></td>
              </tr>

            </table>
            <table id="tab5" border="1">
              <tr>
                <th>Nhóm khách hàng</th>
                <th>Số lượng</th>
                <th>Giá bán</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th></th>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><button id="addsale">+</button></td>
              </tr>

            </table>
            <table id="tab6" border="1">
              <tr>
                <th>Ảnh</th>
                <th>Nhóm Ảnh</th>
                <th>Thứ tự</th>
                <th></th>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><button id="addsale">+</button></td>
              </tr>
              <tr>
                <td><img src="../../../../assetsAdmin/img/product.jpg" alt=""></td>
                <td>Ảnh sản phẩm</td>
                <td>5</td>
                <td><button id="delsale">x</button></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../../../assets/js/jquery.min.js"></script>
  <script src="../../../assetsAdmin/js/chart.min.js"></script>
  <script src="../../../assetsAdmin/js/cat.js"></script>
  <script>
    CKEDITOR.replace('destext');
  </script>
</body>

</html>