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
    <title>Admin::Suppliers</title>
    <script src="../../../../assets/js/axios.js"></script>
</head>

<body>
    <div class="vucms">
    @include('includes.menubar')
        <div class="right">
        @include('includes.top')
            <div class="bottom">
                <div class="headtitle">
                    <p class="sup">NHÀ CUNG CẤP</p>
                    <div class="breadcrumb supbread">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                        <li><span class="main"><a href="{{url()->route('superSeller')}}">Nhà Cung Cấp</a></span></li>

                        </ul>
                    </div>
                    <div class="groupbtn">
                        <a href="{{url()->route('superAddSeller')}}" class="add"><button id="add">+</button></a>
                        <a href="" class="f5"><button id="f5"><i class="fas fa-sync"></i></button></a>
                        <a href="javascript:void(0)" onclick="deleteSelected()" class="remove"><button id="remove"><i
                                    class="far fa-trash-alt"></i></button></a>
                    </div>
                </div>
                <div class="catlist">
                    <p class="cattitle">
                        <i class="fas fa-list-ul"></i> Nhà Cung Cấp
                    </p>
                    <div class="tabcat sup" id="listbox">
                        <table border="1">
                            <tr>
                                <th><input type="checkbox" id="checkall"></th>
                                <th>Ảnh</th>
                                <th>Tên Gian Hàng</th>
                                <th>Email</th>
                                <th>Sản Phẩm</th>
                                <th>Đã Bán</th>
                                <th>Đánh Giá</th>
                                <th>Tham Gia Từ</th>
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($sellers as $seller)
                            <tr>
                                <td><input data-idcat="{{$seller->id}}" type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="{{url($seller->getAvatar() ?? '')}}" alt=""></p>
                                </td>
                                <td><a href="#supplier">{{$seller->name}}</a></td>
                                <td>{{$seller->email}}</td>
                                <td>{{$seller->Products()->count()}}</td>
                                <td>{{$seller->getTotalSelled()}}</td>
                                <td>{{$seller->Reviews()->count()}}</td>
                            <td>{{$seller->JoinTime()}} Ngày trước</td>
                                <td><a href="{{url()->route('superEditSeller',['id'=>$seller->id])}}"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="paginationx">
                            {{$sellers->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="../../../../assets/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script>
        function deleteSelected(){
            if(selectedCat.length ==0) return;
            if(confirm('Bạn có chắc muốn xoá nhà cung cấp này') ){
                axios.post('{{url()->route('superDeleteEditSeller')}}',{
                    ids:selectedCat
                }).then(d=>{
                    data = d.data
                    window.location.reload()
                })  
            }   
        }
    </script>
</body>

</html>