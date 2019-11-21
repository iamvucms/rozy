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
    <title>Admin::Coupon::Add</title>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right">
            @include('includes.top')
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
                        <i class="fas fa-pen-nib"> </i> Thêm Coupon
                    </p>
                    <div class="tabcat">
                        <table>

                            <tr>
                                <td>Sự kiện</td>
                                <td><input type="text" placeholder="Tên Sự kiện"></td>
                            </tr>
                            <tr>
                                <td>Mô tả Sự kiện</td>
                                <td><textarea name="" id="" style="width:100%" placeholder="Mô tả Sự kiện"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Mã Coupon</td>
                                <td><input type="text" placeholder="Mã Coupon"></td>
                            </tr>
                            <tr>
                                <td>Số Lần Sử dụng</td>
                                <td><input type="number" placeholder="" value="5"></td>
                            </tr>
                            <tr>
                                <td>Ngày Hết Hạn</td>
                                <td><input type="text" placeholder="dd/mm/yy"></td>
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
                                <td>Trạng Thái</td>
                                <td>
                                    <select name="aa" id="">
                                        <option value="--">Hoạt Động</option>
                                        <option value="like">Hết Hạn</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><button class="cancelcat">Hủy</button></td>
                                <td><button class="addcat">Thêm</button></td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assetsAdmin/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script>
    </script>
</body>

</html>