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
                    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
                    crossorigin="anonymous">
          <title>Admin::Orders</title>
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
                                                                      <p class="online"><span
                                                                                          class="pointonline"></span>
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
                                                                      <li class="lv1"><a href="index.html">                                                                                 <i class="fas fa-tachometer-alt"></i>                                                                                 <span class="navtext">Bảng điều                                                                                           khiển</span>                                                                       </a>                                                                       </li>
                                                                      <li class="lv1"><i class="fas fa-chart-bar"></i>
                                                                                <span class="navtext">Quản lí</span><i
                                                                                          class="fas fa-angle-right"></i>
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
                                                                      <li class="lv1"><i class="fas fa-users"></i> <span
                                                                                          class="navtext">Khách hàng</span><i
                                                                                          class="fas fa-angle-right"></i>
                                                                                          <ul class="lv2items">
                                                                                                    <li class="lv2"><a href="customer.html">Danh sách</a></li>
                                                                                                    <li class="lv2"><a href="customer_group.html">Nhóm</a></li>
                                                                                                    <li class="lv2"><a href="customer_ban.html">Danh sách bị cấm</a></li>
                                                                                          </ul>
                                                                      </li>
                                                                      <li class="lv1"><i
                                                                                          class="fas fa-shopping-cart"></i>
                                                                                <span class="navtext">Bán hàng</span><i
                                                                                          class="fas fa-angle-right"></i>
                                                                                          <ul class="lv2items">
                                                                                                    <li class="lv2"><a href="order.html">Đơn hàng</a></li>
                                                                                                    <li class="lv2"><a href="coupon.html">Coupon</a></li>
                                                                                          </ul>
                                                                      </li>
                                                                      <li class="lv1"><i class="fas fa-desktop"></i>
                                                                                <span class="navtext">Thiết Kế</span><i
                                                                                          class="fas fa-angle-right"></i>
                                                                                <ul class="lv2items">
                                                                                          <li class="lv2"><a href="layout.html">Bố cục</a></li>
                                                                                          <li class="lv2"><a href="banner.html">Banner</a></li>
                                                                                          <li class="lv2"><a href="seotool.html">Công cụ SEO</a></li>
                                                                                </ul>
                                                                      </li>     
                                                                      <li class="lv1"><i class="fas fa-list-ul"></i>
                                                                                <span class="navtext">Tiện ích</span><i
                                                                                          class="fas fa-angle-right"></i>
                                                                                <ul class="lv2items">
                                                                                          <li class="lv2">Biên soạn</li>
                                                                                          <li class="lv2">Subcategory 2</li>
                                                                                          <li class="lv2">Subcategory 3</li>
                                                                                          <li class="lv2">Subcategory 4</li>
                                                                                          <li class="lv2">Subcategory 5</li>
                                                                                </ul>
                                                                      </li>     
                                                                      <li class="lv1"><a href="setting.html"><i class="fas fa-cogs"></i> <span
                                                                                class="navtext">Cài đặt
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
                                                                      <li><i class="fas fa-id-card-alt"></i> <a
                                                                                          href="#">&nbsp; Trang Cá
                                                                                          Nhân</a></li>
                                                                      <li><i class="far fa-envelope"> </i> <a
                                                                                          href="#">&nbsp; Tin nhắn của
                                                                                          bạn</a></li>
                                                                      <li><i class="far fa-bell"></i> <a href="#">&nbsp;
                                                                                          Tất cả thông bá</a>o</li>
                                                                      <li><i class="fas fa-sign-out-alt"></i> <a
                                                                                          href="#">&nbsp; Đăng xuất</a>
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
                                        <div class="tongquan tabcat">
                                                  <div class="totalitem">
                                                            <div class="centeritemt">
                                                                      <p class="numt">
                                                                                550
                                                                      </p>
                                                                      <p class="dest">
                                                                                Tổng Đơn Hàng
                                                                      </p>
                                                            </div>
                                                            <span class="toprightt">
                                                                      <span class="up">
                                                                                <span class="percentt">6%</span> <i class="fas fa-angle-up"></i>
                                                                      </span> 
                                                            </span>
                                                  </div>
                                                  <div class="totalitem">
                                                            <div class="centeritemt">
                                                                      <p class="numt">
                                                                                15
                                                                      </p>
                                                                      <p class="dest">
                                                                                Đơn Hàng hôm nay
                                                                      </p>
                                                            </div>
                                                            <span class="toprightt">
                                                                      <span class="up">
                                                                                <span class="percentt">20%</span> <i class="fas fa-angle-up"></i>
                                                                      </span> 
                                                            </span>
                                                  </div>
                                                  <div class="totalitem">
                                                            <div class="centeritemt">
                                                                      <p class="numt">
                                                                                45
                                                                      </p>
                                                                      <p class="dest">
                                                                                Đơn Hàng Thành Công
                                                                      </p>
                                                            </div>
                                                            <span class="toprightt">
                                                                      <span class="down">
                                                                                <span class="percentt">2%</span> <i class="fas fa-angle-down"></i>
                                                                      </span> 
                                                            </span>
                                                  </div>
                                                  <div class="totalitem">
                                                            <div class="centeritemt">
                                                                      <p class="numt">
                                                                                12
                                                                      </p>
                                                                      <p class="dest">
                                                                                Đơn Hàng Trả Lại
                                                                      </p>
                                                            </div>
                                                            <span class="toprightt">
                                                                      <span class="up">
                                                                                <span class="percentt">10%</span> <i class="fas fa-angle-up"></i>
                                                                      </span> 
                                                            </span>
                                                  </div>
                                                  
                                                  <div class="totalitem">
                                                            <div class="centeritemt">
                                                                      <p class="numt">
                                                                                100
                                                                      </p>
                                                                      <p class="dest">
                                                                                Đơn hàng đã hủy
                                                                      </p>
                                                            </div>
                                                            <span class="toprightt">
                                                                      <span class="down">
                                                                                <span class="percentt">10%</span> <i class="fas fa-angle-down"></i>
                                                                      </span> 
                                                            </span>
                                                  </div>
                                                  <div class="totalitem">
                                                            <div class="centeritemt">
                                                                      <p class="numt">
                                                                                5
                                                                      </p>
                                                                      <p class="dest">
                                                                                Đơn hàng đang chờ
                                                                      </p>
                                                            </div>
                                                            <span class="toprightt">
                                                                      <span class="up">
                                                                                <span class="percentt">3%</span> <i class="fas fa-angle-up"></i>
                                                                      </span> 
                                                            </span>
                                                  </div>
                                        </div>
                                        <div class="catlist">
                                                  <div class="cattitle">
                                                            <span><i class="fas fa-list-ul"></i> Tất Cả Đơn Hàng</span>
                                                            <ul class="catright">
                                                                      <li><i class="fas fa-filter"></i> Tất Cả <i class="fas fa-angle-down"></i>
                                                                                <ul>
                                                                                          <li>hôm nay</li>
                                                                                          <li>hôm qua</li>
                                                                                          <li>đã xử lí</li>
                                                                                          <li>đang chờ</li>
                                                                                          <li>đã hủy</li>
                                                                                          <li>bị trả lại</li>
                                                                                </ul></li>
                                                                      <li><i class="fas fa-sort-amount-up"></i> Sắp Xếp <i class="fas fa-angle-down"></i>
                                                                                <ul>
                                                                                          <li>Mặc định</li>
                                                                                          <li><i class="fas fa-sort-amount-up"></i> Giá trị </li>
                                                                                          <li><i class="fas fa-sort-amount-down"></i> Giá trị </li>
                                                                                          <li><i class="far fa-clock"></i> Thời gian</li>
                                                                                </ul></li>
                                                                      <li><i class="fas fa-radiation"></i> Thao Tác <i class="fas fa-angle-down"></i>
                                                                                <ul>
                                                                                          <li><a href="addorder.html" style="color:#555"><i class="fas fa-plus-circle"></i> Thêm mới</a></li>
                                                                                          <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                          <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                </ul>
                                                                      </li>
                                                            </ul>
                                                  </div>
                                                  <div class="tabcat taborder" id="listbox">
                                                            <table border="1">
                                                                      <tr>
                                                                                <th><input type="checkbox" id="checkall"></th>
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
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>10277</td>
                                                                                <td><a href="#customer">Cecilia Hicks</a></td>
                                                                                <td>VAT17489</td>
                                                                                <td>3,800,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div></td>
                                                                                <td>6/21/2058</td>
                                                                                <td>1/18/2045</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                               <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>17999</td>
                                                                                <td><a href="#customer">Mitchell Garza</a></td>
                                                                                <td>VAT13251</td>
                                                                                <td>15,600,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div></td>
                                                                                <td>6/29/2081</td>
                                                                                <td>9/21/2031</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>16237</td>
                                                                                <td><a href="#customer">Larry Frazier</a></td>
                                                                                <td>VAT13288</td>
                                                                                <td>14,600,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div>
                                                                                </td>
                                                                                <td>10/21/2031</td>
                                                                                <td>9/16/2079</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>16763</td>
                                                                                <td><a href="#customer">Flora Cortez</a></td>
                                                                                <td>VAT13307</td>
                                                                                <td>1,800,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div></td>
                                                                                <td>3/30/2104</td>
                                                                                <td>5/28/2042</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>12928</td>
                                                                                <td><a href="#customer">Emma Wilkins</a></td>
                                                                                <td>VAT10169</td>
                                                                                <td>6,100,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div></td>
                                                                                <td>3/18/2084</td>
                                                                                <td>9/10/2095</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>12066</td>
                                                                                <td><a href="#customer">Danny Bush</a></td>
                                                                                <td>VAT15887</td>
                                                                                <td>14,200,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div></td>
                                                                                <td>3/29/2043</td>
                                                                                <td>8/7/2026</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>15992</td>
                                                                                <td><a href="#customer">Helena Reese</a></td>
                                                                                <td>VAT16977</td>
                                                                                <td>14,100,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div></td>
                                                                                <td>11/6/2099</td>
                                                                                <td>2/7/2093</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>12620</td>
                                                                                <td><a href="#customer">George Moreno</a></td>
                                                                                <td>VAT12640</td>
                                                                                <td>4,300,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div></td>
                                                                                <td>1/13/2102</td>
                                                                                <td>7/23/2094</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>14334</td>
                                                                                <td><a href="#customer">Lois Weaver</a></td>
                                                                                <td>VAT11836</td>
                                                                                <td>1,600,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div></td>
                                                                                <td>4/16/2085</td>
                                                                                <td>10/16/2062</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>19254</td>
                                                                                <td><a href="#customer">Jeffrey Harper</a></td>
                                                                                <td>VAT12639</td>
                                                                                <td>12,300,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="com"></span>
                                                                                                    <span class="stttext">Hoàn Thành</span>
                                                                                          </div></td>
                                                                                <td>8/13/2101</td>
                                                                                <td>9/2/2024</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>15200</td>
                                                                                <td><a href="#customer">Floyd Stevenson</a></td>
                                                                                <td>VAT13792</td>
                                                                                <td>4,400,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="pen"></span>
                                                                                                    <span class="stttext">Chờ xử lý</span>
                                                                                          </div></td>
                                                                                <td>8/5/2058</td>
                                                                                <td>12/11/2031</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>15768</td>
                                                                                <td><a href="#customer">Jimmy Figueroa</a></td>
                                                                                <td>VAT11280</td>
                                                                                <td>10,600,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="pen"></span>
                                                                                                    <span class="stttext">Chờ xử lý</span>
                                                                                          </div></td>
                                                                                <td>10/7/2070</td>
                                                                                <td>10/21/2119</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>10679</td>
                                                                                <td><a href="#customer">William Dawson</a></td>
                                                                                <td>VAT18719</td>
                                                                                <td>8,600,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="pen"></span>
                                                                                                    <span class="stttext">Chờ xử lý</span>
                                                                                          </div></td>
                                                                                <td>3/19/2048</td>
                                                                                <td>5/7/2083</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>19237</td>
                                                                                <td><a href="#customer">Jose Fuller</a></td>
                                                                                <td>VAT16828</td>
                                                                                <td>8,500,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="pen"></span>
                                                                                                    <span class="stttext">Chờ xử lý</span>
                                                                                          </div></td>
                                                                                <td>7/7/2067</td>
                                                                                <td>2/13/2093</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>13661</td>
                                                                                <td><a href="#customer">Lillie Baker</a></td>
                                                                                <td>VAT10007</td>
                                                                                <td>7,900,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="pen"></span>
                                                                                                    <span class="stttext">Chờ xử lý</span>
                                                                                          </div></td>
                                                                                <td>3/19/2106</td>
                                                                                <td>7/22/2097</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>10086</td>
                                                                                <td><a href="#customer">Mathilda Chavez</a></td>
                                                                                <td>VAT19090</td>
                                                                                <td>13,800,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="not"></span>
                                                                                                    <span class="stttext">Đã hủy</span>
                                                                                          </div></td>
                                                                                <td>4/23/2097</td>
                                                                                <td>7/12/2073</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                                      <tr>
                                                                                <td><input type="checkbox" id="check"></td>
                                                                                <td>16161</td>
                                                                                <td><a href="#customer">Leo Mathis</a></td>
                                                                                <td>VAT19884</td>
                                                                                <td>15,600,000 VND</td>
                                                                                <td><div class="tabstt">
                                                                                                    <span class="point" id="not"></span>
                                                                                                    <span class="stttext">Đã hủy</span>
                                                                                          </div></td>
                                                                                <td>3/9/2043</td>
                                                                                <td>12/8/2097</td>
                                                                                <td><div class="lasttd">
                                                                                          <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                                                                          <li id="showoption"><i class="fas fa-angle-down"></i>
                                                                                                    <ul>
                                                                                                               <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                                                                              <li><a href="editorder.html" style="color:#555"><i class="far fa-edit"></i> Cập Nhật</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="fas fa-print"></i> In đơn hàng</a></li>
                                                                                                              <li><a href="print.html" style="color:#555" target="__blank"><i class="far fa-file-powerpoint"></i> In đơn vận chuyển</a></li>
                                                                                                    </ul>
                                                                                          </li>
                                                                                </div>
                                                                                </td>
                                                                      </tr>
                                                            </table>
                                                            <div class="pagination">
                                                                      <ul>
                                                                                <li class="active"><a href="javascript:void(0)">1</a></li>
                                                                                <li><a href="javascript:void(0)">2</a></li>
                                                                                <li><a href="javascript:void(0)">3</a></li>
                                                                                <li><a href="javascript:void(0)"><i class="fas fa-angle-right"></i></a></li>
                                                                                <li><a href="javascript:void(0)"><i class="fas fa-step-forward"></i></a></li>
                                                                      </ul>
                                                            </div>
                                                  </div>

                                        </div>
                              </div>
                    </div>
          </div>
<script src="../../../assetsAdmin/js/jquery.min.js"></script>
<script src="../../assetsAdmin/js/chart.min.js"></script>
<script src="../../assetsAdmin/js/cat.js"></script>
<script>
</script>
</body>

</html>