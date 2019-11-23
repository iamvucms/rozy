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
    <title>Admin::Coupon</title>
    <script src="../../assets/js/axios.js"></script>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right">
            @include('includes.top')
            <div class="bottom">
                <div class="headtitle">
                    <p>Coupon</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Coupon</a></span></li>

                        </ul>
                    </div>
                    <div class="groupbtn">
                        <a href="{{url()->route('superAddCoupon')}}" class="add"><button id="add">+</button></a>
                        <a href="" class="f5"><button id="f5"><i class="fas fa-sync"></i></button></a>
                        <a href="javascript:void(0)" onclick="deleteSelected()" class="remove"><button id="remove"><i
                                    class="far fa-trash-alt"></i></button></a>
                    </div>
                </div>
                <div class="catlist">
                    <p class="cattitle">
                        <i class="fas fa-list-ul"></i> Danh Mục Sách Mã Coupon
                    </p>
                    <div class="tabcat" id="listbox">
                        <table border="1">
                            <tr>
                                <th></th>
                                <th>Tên Sự Kiện</th>
                                <th>Phạm Vi</th>
                                <th>Mã Code</th>
                                <th style="min-width:100px!important">Giá Trị</th>
                                <th>Số Lần Sử Dụng</th>
                                <th>Hêt Hạn</th>
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($coupons as $cp)
                            <tr>
                                <td><input data-idcat="{{$cp->id}}" type="checkbox" id="check"></td>
                                <td>{{$cp->name}}</td>
                            <td>@if($cp->idsell==0) Toàn Hệ Thống @else Shop: <a href="{{url()->route('superEditSeller',['id'=>$cp->Seller->id])}}">{{$cp->Seller->name}}</a> @endif</td>
                                <td>{{$cp->code}}</td>
                                <td>{{number_format($cp->value)}} VND</td>
                                <td>{{number_format($cp->max_using)}}</td>
                                <td>{{Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($cp->expired,'Asia/Ho_Chi_Minh')) <60 ? Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($cp->expired,'Asia/Ho_Chi_Minh')).' phút' : (Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInHours(Carbon\Carbon::parse($cp->expired,'Asia/Ho_Chi_Minh'))<24?Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInHours(Carbon\Carbon::parse($cp->expired,'Asia/Ho_Chi_Minh')).' giờ':Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInDays(Carbon\Carbon::parse($cp->expired,'Asia/Ho_Chi_Minh')).' ngày')}} nữa</td>
                                <td><a href="{{url()->route('superEditCoupon',['id'=>$cp->id])}}"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="paginationx">
                            {{$coupons->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="../../../assets/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script>
        function deleteSelected(){
            if(selectedCat.length ==0) return;
            if(confirm('Bạn có chắc muốn xoá '+selectedCat.length+' coupon này') ){
                axios.post('{{url()->route('superDeleteEditCoupon')}}',{
                    ids:selectedCat
                }).then(d=>{
                    window.location.reload()
                })  
            }   
        }
    </script>
</body>

</html>