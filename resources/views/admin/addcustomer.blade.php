<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../../assetsAdmin/css/cat.css">
    <link rel="stylesheet" href="../../../assetsAdmin/css/order.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="../../../assetsAdmin/ckeditor/ckeditor.js"></script>
    <title>Admin::Customers::Add</title>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right">
        @include('includes.top')
            <div class="bottom">
                <div class="headtitle">
                    <p style="max-width:200px;">KHÁCH HÀNG</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Khách Hàng</a></span></li>

                        </ul>
                    </div>

                </div>
                <div class="catlist" id="add">
                    <p class="cattitle">
                        <i class="fas fa-pen-nib"> </i> Thêm Khách Hàng
                    </p>
                    <div class="tabcat">
                        <div class="panel">
                            <ul>
                                <li data-id="tab1" class="active">1. Thông tin</li>
                                <li data-id="tab2">2. Tài Khoản</li>
                            </ul>
                        </div>
                        <form enctype="multipart/form-data" action="{{url()->route('superPostAddCustomer')}}" method="POST">
                            @csrf
                            <table id="tab1">
                            <tr>
                                <td>Họ Tên Khách Hàng</td>
                                <td><input required name="name" type="text" placeholder="Họ Tên Khách Hàng"></td>
                            </tr>
                            <tr>
                                <td>Ảnh đại diện</td>
                                <td>
                                    <img id="avatarImg" src="" alt="" style="display:none;width:80px;height:80px">
                                    <input onchange="readURL(this)" accept="image/gif, image/jpeg, image/png" required name="avatar" id="avatar" type="file" style="display:none" placeholder="Địa chỉ">
                                    <label for="avatar" style="border:1px solid #ddd;padding:5px;cursor:pointer;height:40px;line-height:30px;margin-bottom:0px;">Chọn ảnh</label>
                                </td>
                            </tr>
                            <script>
                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            document.querySelector('#avatarImg').style.display = 'inline-block'
                                            document.querySelector('#avatarImg').setAttribute('src',e.target.result)
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            </script>
                            <tr>
                                <td>Địa chỉ</td>
                                <td><input required name="address" type="text" placeholder="Địa chỉ"></td>
                            </tr>
                            <tr>
                                <td>Nhóm Khách Hàng</td>
                                <td>
                                    <select required name="group_type" id="">
                                        <option value="0">Mặc Định</option>
                                        <option value="1">Khách Hàng Tích Cực</option>
                                        <option value="2">Khách Hàng Tiềm Năng</option>
                                        <option value="3">Khách Hàng Thân Thiết</option>
                                        <option value="4">Khách Hàng Bị Cấm</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Giới tính</td>
                                <td>
                                    <select required name="gender" id="">
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td><input required name="phone" type="text" placeholder="Số điện thoại khách hàng"></td>
                            </tr>
                            <tr>
                                <td>Nhận Tin</td>
                                <td>
                                    <select required name="notification" id="">
                                        <option value="1">Bật </option>
                                        <option value="0">Tắt</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <table id="tab2">
                            <tr>
                                <td>Email/Tên Người Dùng</td>
                                <td><input name="email" required type="text" placeholder="Email Khách Hàng"></td>
                            </tr>
                            <tr>
                                <td>Mật Khẩu</td>
                                <td><input name="password" type="password" placeholder="Mật Khẩu"></td>
                            </tr>
                            <tr>
                                <td>Nhập Lại Mật Khẩu</td>
                                <td><input name="cpassword" type="password" placeholder="Nhập Lại Mật Khẩu"></td>
                            </tr>
                        </table>
                        <tr>
                            <td><button class="cancelcat" onclick="window.location.href = '{{url()->route('superCustomer')}}';return false">Hủy</button></td>
                            <td><button class="addcat">Thêm</button></td>
                        </tr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../../assets/js/jquery.min.js"></script>
    <script src="../../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../../assetsAdmin/js/cat.js"></script>

</body>

</html>