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
    <title>Admin::Customers::Update</title>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
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
                        <i class="fas fa-pen-nib"> </i> Cập Nhật Khách Hàng
                    </p>
                    <div class="tabcat">
                        <div class="panel">
                            <ul>
                                <li data-id="tab1" class="active">1. Thông tin</li>
                            </ul>
                        </div>
                        <form enctype="multipart/form-data" action="{{url()->route('superPostEditCustomer',['id'=>$customer->id])}}" method="POST">
                            @csrf
                            <table id="tab1">
                            <tr>
                                <td>Họ Tên Khách Hàng</td>
                            <td><input value="{{$customer->name}}" required name="name" type="text" placeholder="Họ Tên Khách Hàng"></td>
                            </tr>
                            <tr>
                                <td>Ảnh đại diện</td>
                                <td>
                                    <img id="avatarImg" src="{{url($customer->Image->src ?? 'https://png.pngtree.com/svg/20160601/unknown_avatar_182562.png')}}" alt="" style="width:80px;height:80px">
                                    <input onchange="readURL(this)" accept="image/gif, image/jpeg, image/png"  name="avatar" id="avatar" type="file" style="display:none" placeholder="Địa chỉ">
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
                                <td><input value="{{$customer->address}}" required name="address" type="text" placeholder="Địa chỉ"></td>
                            </tr>
                            <tr>
                                <td>Nhóm Khách Hàng</td>
                                <td>
                                    <select required name="group_type" id="">
                                        <option value="0" @if($customer->group_type==0)selected=selected @endif>Mặc Định</option>
                                        <option value="1" @if($customer->group_type==1)selected=selected @endif>Khách Hàng Tích Cực</option>
                                        <option value="2" @if($customer->group_type==2)selected=selected @endif>Khách Hàng Tiềm Năng</option>
                                        <option value="3" @if($customer->group_type==3)selected=selected @endif>Khách Hàng Thân Thiết</option>
                                        <option value="4" @if($customer->group_type==4)selected=selected @endif>Khách Hàng Bị Cấm</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Giới tính</td>
                                <td>
                                    <select required name="gender" id="">
                                        <option value="1" @if($customer->gender==1)selected=selected @endif>Nam</option>
                                        <option value="2" @if($customer->gender==2)selected=selected @endif>Nữ</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td><input value="{{$customer->phone}}" required name="phone" type="text" placeholder="Số điện thoại khách hàng"></td>
                            </tr>
                            <tr>
                                <td>Nhận Tin</td>
                                <td>
                                    <select required name="notification" id="">
                                        <option value="1" @if($customer->notification==1)selected=selected @endif>Bật </option>
                                        <option value="0" @if($customer->notification==0)selected=selected @endif>Tắt</option>
                                    </select>
                                </td>
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