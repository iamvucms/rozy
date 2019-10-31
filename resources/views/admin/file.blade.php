<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/cat.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/file.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Files</title>
</head>

<body>
    <div class="vucms">
        <div class="foldercreate">
            <div class="foldertop">
                <span>Tạo Thư Mục</span>
                <span class="closefolder">×</span>
            </div>
            <div class="folderbottom">
                <form action="">
                    <input type="text" placeholder="Tên thư mục"><button>Tạo</button>
                </form>
            </div>
        </div>
        <div class="renamebox">
            <div class="foldertop">
                <span>Đổi tên</span>
                <span class="closefolder">×</span>
            </div>
            <div class="folderbottom">
                <form action="">
                    <input type="text" placeholder="Tên thư mục" value="Heehee"><button>Đổi</button>
                </form>
            </div>
        </div>
        <div class="rclickmenu">
            <ul>
                <li class="s2"><i class="far fa-trash-alt"></i> Xóa</li>
                <li class="s2" id="renamebtn2"><i class="fas fa-file-signature"></i> Đổi tên</li>
                <li class="s2"><i class="fas fa-copy"></i> Copy</li>
                <li class="s2"><i class="fas fa-paste"></i> Dán</li>
                <li class="s2"><i class="fas fa-expand-arrows-alt"></i> Di chuyển</li>
            </ul>
        </div>
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
                    <p>Files</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Quản Lí File</a></span></li>

                        </ul>
                    </div>
                </div>
                <div class="catlist">
                    <p class="cattitle">
                        <i class="fas fa-list-ul"></i> Quản Lí File
                    </p>
                    <div class="filelist">
                        <div class="files">
                            <div class="filetool">
                                <div class="toptool">
                                    <button id="upbtn"><i class="fas fa-cloud-upload-alt"></i><label for="upfile">Tải
                                            lên</label></button>
                                    <input type="file" name="upfile" id="upfile" style="display:none">
                                    <button id="folderbtn"><i class="fas fa-folder-plus"></i> Thư mục mới</button>
                                    <a href=""><button><i class="fas fa-sync"></i> Làm mới</button> </a>
                                    <ul class="maintoptool">
                                        <li class="t1"><i class="fas fa-filter"></i> Loại File <i
                                                class="fas fa-angle-down"></i>
                                            <ul>
                                                <li><i class="fas fa-bars"></i> Tất Cả</li>
                                                <li><i class="fas fa-images"></i> Hình Ảnh</li>
                                                <li><i class="fas fa-video"></i> Video</li>
                                                <li><i class="far fa-file-word"></i> Tài liệu</li>
                                            </ul>
                                        </li>
                                        <li class="t1"><i class="fas fa-list"></i> Tất Cả <i
                                                class="fas fa-angle-down"></i>
                                            <ul>
                                                <li><i class="fas fa-bars"></i> Tất Cả</li>
                                                <li><i class="fas fa-history"></i> Vừa Xem</li>
                                                <li><i class="far fa-heart"></i> Yêu thích</li>
                                                <li><i class="fas fa-trash"></i> Thùng Rác</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="bottool">
                                    <div class="csrc">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-globe"></i> Home</a></li>
                                            <li><a href="#"> Files</a></li>
                                            <li><a href="#"> Gallary</a></li>
                                        </ul>
                                    </div>
                                    <div class="rightsort">
                                        <ul class="sortaction">
                                            <li class="s1">
                                                Sắp Xếp <i class="fas fa-sort-alpha-down"></i>
                                                <ul class="actiontool">
                                                    <li class="s2">A-Z <i class="fas fa-sort-alpha-up"></i></li>
                                                    <li class="s2">Z-A <i class="fas fa-sort-alpha-down"></i></li>
                                                    <li class="s2">Thời gian <i class="far fa-clock"></i></li>
                                                    <li class="s2">Size ASC <i class="fas fa-sort-amount-up"></i></li>
                                                    <li class="s2">Size DESC <i class="fas fa-sort-amount-down"></i>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="s1">Thao tác <i class="fas fa-ellipsis-v"></i>
                                                <ul class="actiontool">
                                                    <li class="s2"><i class="far fa-trash-alt"></i> Xóa</li>
                                                    <li class="s2" id="renamebtn"><i class="fas fa-file-signature"></i>
                                                        Đổi tên</li>
                                                    <li class="s2"><i class="fas fa-copy"></i> Copy</li>
                                                    <li class="s2"><i class="fas fa-paste"></i> Dán</li>
                                                    <li class="s2"><i class="fas fa-expand-arrows-alt"></i> Di chuyển
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="filescroll">
                                <div class="filehere">
                                    <div class="thumb">
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder" id="folder">
                                            <div class="centerfolder">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="botfolder">
                                                <span>Heehee</span>
                                            </div>
                                        </div>
                                        <div class="folder imgfile">
                                            <div class="imghere">
                                                <img src="../../../assetsAdmin/img/product.jpg" alt="">
                                            </div>
                                            <div class="botfolder">
                                                <span>since.jpg</span>
                                            </div>
                                        </div>
                                        <div class="folder imgfile">
                                            <div class="imghere">
                                                <img src="../../../assetsAdmin/img/product1.png" alt="">
                                            </div>
                                            <div class="botfolder">
                                                <span>fewer.jpg</span>
                                            </div>
                                        </div>
                                        <div class="folder imgfile">
                                            <div class="imghere">
                                                <img src="../../../assetsAdmin/img/product2.jpg" alt="">
                                            </div>
                                            <div class="botfolder">
                                                <span>loose.jpg</span>
                                            </div>
                                        </div>
                                        <div class="folder imgfile">
                                            <div class="imghere">
                                                <img src="../../../assetsAdmin/img/product4.jpg" alt="">
                                            </div>
                                            <div class="botfolder">
                                                <span>nose.jpg</span>
                                            </div>
                                        </div>
                                        <div class="folder imgfile">
                                            <div class="imghere">
                                                <img src="../../../assetsAdmin/img/product5.jpg" alt="">
                                            </div>
                                            <div class="botfolder">
                                                <span>exactly.jpg</span>
                                            </div>
                                        </div>
                                        <div class="folder imgfile">
                                            <div class="imghere">
                                                <img src="../../../assetsAdmin/img/mega11.jpg" alt="">
                                            </div>
                                            <div class="botfolder">
                                                <span>right.jpg</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="fileinfo">
                                        <div class="imgfileinfo">
                                            <i class="far fa-folder"></i>
                                        </div>
                                        <div class="datafileinfo">
                                            <ul>
                                                <li>
                                                    <b>Tên File/Folder</b>
                                                    <p id="filename">Hello</p>
                                                </li>
                                                <li>
                                                    <b>Thời gian tạo</b>
                                                    <p>08:30 1/1/2083</p>
                                                </li>
                                                <li>
                                                    <b>Cập nhật lúc</b>
                                                    <p>20:15 2/26/2088</p>
                                                </li>
                                                <li>
                                                    <b>Kích thước</b>
                                                    <p>1234KB</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../assetsAdmin/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script src="../../assetsAdmin/js/file.js"></script>
    <script>
    </script>
</body>

</html>