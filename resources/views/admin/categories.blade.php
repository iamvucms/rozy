<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/cat.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Categories</title>
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
                            <li class="lv1"><a href="{{url()->route('dashboard')}}"> <i class="fas fa-tachometer-alt"></i> <span
                                        class="navtext">Bảng điều khiển</span> </a> </li>
                            <li class="lv1"><i class="fas fa-chart-bar"></i>
                                <span class="navtext">Quản lí</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="{{url()->route('superCategory')}}">Danh mục</a></li>
                                    <li class="lv2"><a href="{{url()->route('superProduct')}}">Sản phẩm</a></li>
                                    <li class="lv2"><a href="{{url()->route('superReview')}}">Đánh giá</a></li>
                                    <li class="lv2"><a href="{{url()->route('superSeller')}}">Nhà cung cấp</a></li>
                                    <li class="lv2"><a href="{{url()->route('superFile')}}">Files</a></li>
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
                    <p>DANH MỤC</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Danh Mục</a></span></li>

                        </ul>
                    </div>
                    <div class="groupbtn">
                        <a href="addcat.html" class="add"><button id="add">+</button></a>
                        <a href="" class="f5"><button id="f5"><i class="fas fa-sync"></i></button></a>
                        <a href="javascript:void(0)" class="remove"><button id="remove"><i
                                    class="far fa-trash-alt"></i></button></a>
                    </div>
                </div>
                <div class="catlist">
                    <p class="cattitle">
                        <i class="fas fa-list-ul"></i> Danh Mục Sản Phẩm
                    </p>
                    <div class="tabcat" id="listbox">
                        <table border="1">
                            <tr>
                                <th></th>
                                <th>Ảnh Danh Mục</th>
                                <th>Tên Danh Mục</th>
                                <th>Thứ tự</th>
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($categories as $cat)
                            <tr>
                            <td><input data-idcat="{{$cat->id}}" type="checkbox" id="checkCat"></td>
                                <td><img src="{{url($cat->img)}}" alt="" style="height:70px;width:70px;border:1px solid #ddd;padding:5px;margin:5px"></td>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->order}}</td>
                                <td><a href="{{url()->route('superEditCategory',['slug'=>$cat->slug])}}"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script>
    </script>
</body>

</html>