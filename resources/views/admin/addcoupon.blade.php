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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
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
                        <li><span class="main"><a href="{{url()->route('superCoupon')}}">Coupon</a></span></li>

                        </ul>
                    </div>

                </div>
                <div class="catlist" id="add">
                    <p class="cattitle">
                        <i class="fas fa-pen-nib"> </i> Thêm Coupon
                    </p>
                    <div class="tabcat">
                        <form action="{{url()->route('superPostAddCoupon')}}" method="POST">
                            @csrf
                            <table>
                            <tr>
                                <td>Tên Mã Coupon</td>
                                <td><input @if(isset($errors->toArray()['name']))style="border:1px solid red" @endif required name="name" type="text" placeholder="Tên Mã Coupon"></td>
                            </tr>
                            <tr>
                                <td>Mã Coupon</td>
                                <td><input @if(isset($errors->toArray()['code']))style="border:1px solid red" @endif name="code" required type="text" placeholder="Mã Coupon"></td>
                            </tr>
                            <tr>
                                <td>Số Lần Sử dụng</td>
                                <td><input @if(isset($errors->toArray()['count']))style="border:1px solid red" @endif name="count" min="1" required type="number" placeholder="Số Lần Sử dụng" ></td>
                            </tr>
                            <tr>
                                <td>Giá trị</td>
                                <td><input @if(isset($errors->toArray()['value']))style="border:1px solid red" @endif name="value" min="10000" required type="number" placeholder="Giá trị" ></td>
                            </tr>
                            <tr>
                                <td>Ngày Hết Hạn</td>
                            <td><input @if(isset($errors->toArray()['expired']))style="border:1px solid red" @endif min="{{date('Y-m-d')}}" required name="expired" type="date" placeholder="mm/dd/YYYY"></td>
                            </tr>
                            @if($user->role_id==1)
                            <tr>
                                <td>Phạm Vi</td>
                                <td>
                                <select class="js-example-basic-single" name="idsell">
                                    <option value="0">Toàn Hệ Thống</option>
                                    @foreach ($sellers as $seller)
                                    <option value="{{$seller->id}}">{{$seller->name}}</option>
                                    @endforeach
                                </select>
                                </td>
                            </tr>
                            @endif
                        </table> 
                        <tr>
                        <td><button class="cancelcat" onclick=" window.location.href='{{url()->route('superCoupon')}}';return false">Hủy</button></td>
                            <td><button class="addcat">Thêm</button></td>
                        </tr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="../../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../../assetsAdmin/js/cat.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</body>

</html>