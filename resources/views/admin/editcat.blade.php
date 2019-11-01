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
    <title>Admin::Categories::Edit</title>
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
                            <li class="lv1"><a href="index.html"> <i class="fas fa-tachometer-alt"></i> <span
                                        class="navtext">Bảng điều khiển</span> </a> </li>
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
                    <p>DANH MỤC</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Danh Mục</a></span></li>

                        </ul>
                    </div>

                </div>
                <div class="catlist" id="add">
                    <p class="cattitle">
                        <i class="fas fa-pen-nib"> </i> Thêm Danh Mục
                    </p>
                    <div class="tabcat">
                        
                    <form enctype="multipart/form-data" action="{{url()->route('superPostEditCategory',['slug'=>$cat->slug])}}" method=POST>
                        @csrf
                        <table>
                            <tr>
                                <td>Tên danh mục</td>
                                <td><input @if (@$errors->toArray()['name'])
                                    style="border:1px solid red"
                                    @endif name="name" type="text" value="{{$cat->name}}"></td>
                            </tr>
                            <tr>
                                <td>Ảnh Danh Mục</td>
                                <td><img id="curImg" style="height:80px;width:80px;padding:5px" src="{{url($cat->img)}}" alt="">
                                    <label for="img" style="border:1px solid #ddd;padding:5px;cursor:pointer;height:40px;line-height:30px;margin-bottom:0px;">Chọn ảnh</label>
                                    <input accept="image/gif, image/jpeg, image/png"  onchange="readURL(this)" style="display:none" name="img" id="img" type="file" value="{{$cat->name}}">
                                </td>
                            </tr>
                            
                            <script>
                                    
                                     
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                document.querySelector('#curImg').setAttribute('src',e.target.result)
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                            <tr>
                                <td>Icon Danh Mục(Fontawesome)</td>
                                <td><input @if (@$errors->toArray()['icon'])
                                    style="border:1px solid red"
                                    @endif name="icon" type="text" value="{{$cat->icon}}"></td>
                            </tr>
                            <tr>
                                <td>Mô tả danh mục </td>
                                <td><input name="description" type="text" value="{{$cat->description}}"></td>
                            </tr>
                            <tr>
                                <td>SEO Từ khóa</td>
                                <td><input name="seo_keys" type="text" value="{{$cat->seo_keys}}"></td>
                            </tr>
                            <tr>
                                <td>SEO Mô tả</td>
                                <td><textarea name="seo_description" id=""
                                style="width:100%">{{$cat->seo_description}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Thứ tự</td>
                                <td><input @if (@$errors->toArray()['order'])
                                    style="border:1px solid red"
                                    @endif name="order" type="number" value="{{$cat->order}}"></td>
                            </tr>
                            <tr>
                                <td>SEO URL</td>
                                <td><input @if (@$errors->toArray()['slug'])
                                    style="border:1px solid red"
                                    @endif name="slug" type="text" value="{{$cat->slug}}"></td>
                            </tr>
                            <tr>
                            <td><button onclick="window.location.href='{{url()->route('superCategory')}}';return false;" class="cancelcat">Hủy</button></td>
                                <td><button class="addcat">Lưu Lại</button></td>
                            </tr>
                        </table>
                    </form>
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