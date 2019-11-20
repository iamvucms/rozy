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
    <title>Admin::Customers</title>
    <script src="../../../../assets/js/axios.js"></script>
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
                <div class="tongquan tabcat">
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$customers->count()}}
                            </p>
                            <p class="dest">
                                Tổng khách hàng
                            </p>
                        </div>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                @php $newCus = (new App\Customer)->getCountNewCustomer() @endphp
                                {{$newCus['total']}}
                            </p>
                            <p class="dest">
                                Khách Hàng Mới
                            </p>
                        </div>
                        <span class="toprightt">
                            <span class="{{$newCus['percent']>=100?'up':'down'}}">
                                <span class="percentt">{{$newCus['percent']}}%</span> <i class="fas fa-angle-{{$newCus['percent']>=100?'up':'down'}}"></i>
                            </span>
                        </span>
                    </div>
                    @php
                        $obj = new App\Customer;  
                    @endphp
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$obj->getCountCustomerByType(1)}}
                            </p>
                            <p class="dest">
                                Khách Hàng Tích Cực
                            </p>
                        </div>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$obj->getCountCustomerByType(2)}}
                            </p>
                            <p class="dest">
                                Khách hàng Thân thiết
                            </p>
                        </div>
                        
                    </div>

                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$obj->getCountCustomerByType(3)}}
                            </p>
                            <p class="dest">
                                Khách Hàng Tiềm Năng
                            </p>
                        </div>
                        
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$obj->getCountCustomerByType(3)}}
                            </p>
                            <p class="dest">
                                Khách Hàng Bị Cấm
                            </p>
                        </div>
                    </div>
                </div>
                <div class="catlist">
                    <div class="cattitle">
                        <span><i class="fas fa-list-ul"></i> Tất Cả Đơn Hàng</span>
                        <ul class="catright">
                            <li><i class="fas fa-filter"></i> Tất Cả <i class="fas fa-angle-down"></i>
                                <ul style="width:auto;">
                                    <li onclick="filter(0)">Tất Cả </li>
                                    <li onclick="filter(1)">Khách Hàng Tích Cực</li>
                                    <li onclick="filter(2)">Khách hàng Thân thiết</li>
                                    <li onclick="filter(3)">Khách Hàng Tiềm Năng</li>
                                    <li onclick="filter(4)">Khách Hàng Bị Cấm</li>
                                </ul>
                            </li>
                            <li><i class="fas fa-sort-amount-up"></i> Sắp Xếp <i class="fas fa-angle-down"></i>
                                <ul>
                                    <li onclick="orderBy(0)">Mặc định</li>
                                    <li onclick="orderBy(1)"><i class="fas fa-sort-amount-up"></i> Tiêu dùng</li>
                                    <li onclick="orderBy(2)"><i class="fas fa-sort-amount-down"></i> Tiêu dùng</li>
                                    <li onclick="orderBy(3)"><i class="far fa-clock"></i> Đánh giá</li>
                                </ul>
                            </li>
                            <li><i class="fas fa-radiation"></i> Thao Tác <i class="fas fa-angle-down"></i>
                                <ul>
                                    <li><a href="{{url()->route('superAddCustomer')}}" style="color:#555"><i class="fas fa-plus-circle"></i>
                                            Thêm mới</a></li>
                                    <li onclick="deleteSelected()"><i class="far fa-trash-alt"></i> Xóa</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="tabcat taborder" id="listbox">
                        <table border="1">
                            <div>
                                <th></th>
                                <th>Ảnh Đại Diện</th>
                                <th>Tên Khách Hàng</th>
                                <th>Nhóm Khách Hàng</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>đánh giá</th>
                                <th>Tổng Đơn Hàng</th>
                                <th>Tông Tiêu Dùng</th>
                                <th>Vai trò khác</th>
                                <th>IP</th>
                                <th>Ngày Tham Gia</th>
                                <th>Thao tác</th>
                            </div>
                          @foreach ($customers as $customer)
                        <tr data-money="{{$customer->Orders->sum('total')}}"  data-id="{{$customer->id}}" data-type="{{$customer->group_type}}" data-review="{{$customer->Reviews->count()}}">
                            <td><input data-idcat="{{$customer->id}}" type="checkbox" id="check"></td>
                            <td><img src="{{url($customer->Image->src ?? 'https://png.pngtree.com/svg/20160601/unknown_avatar_182562.png')}}" style="width:80px;height:80px;padding:5px;border-radius:50%;border:1px dashed tomato;margin:10px" alt=""></td>
                                <td><a href="{{url()->route('superEditCustomer',['id'=>$customer->id])}}">{{$customer->name}}</a></td>
                                <td>@switch($customer->group_type)
                                    @case(0)
                                        {{'Mặc định'}}
                                        @break
                                    @case(1)
                                        {{'Khách hàng tích cực'}}
                                        @break
                                    @case(2)
                                        {{'Khách hàng thân thiết'}}
                                        @break
                                    @case(3)
                                        {{'Khách hàng tìm năng'}}
                                        @break
                                    @case(4)
                                        {{'Khách hàng bị cấm'}}
                                        @break
                                    @default
                                        
                                @endswitch</td>
                                <td>{{$customer->User->email}}</td>
                                <td>
                                    <div class="tabstt">
                                        @if ($customer->group_type!=4)
                                        <span class="point" id="com"></span>
                                        <span class="stttext">Hoạt Động</span>
                                        @else 
                                        <span class="point" id="not"></span>
                                        <span class="stttext">Ngưng Hoạt Động</span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{$customer->Reviews->count()}}</td>
                                <td>{{$customer->Orders->count()}}</td>
                                <td>{{number_format($customer->Orders->sum('total'))}} VND</td>
                                <td style="color:red">@switch($customer->User->role_id)
                                    @case(1)
                                        {{'Quản trị viên'}}
                                        @break
                                    @case(2)
                                        {{'Shipper'}}
                                        @break
                                    @case(3)
                                        {{'Nhà cung cấp'}}
                                        @break
                                    @case(4)
                                        {{'Khách hàng'}}
                                        @break
                                    @default
                                        
                                @endswitch</td>
                                <td>{{$customer->User->last_login_ip}}</td>
                                <td>{{date('d/m/Y',strtotime($customer->create_at))}}</td>
                                <td>
                                    <div class="lasttd">
                                        <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                        <li id="showoption"><i class="fas fa-angle-down"></i>
                                            <ul>
                                                <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                <li><a href="{{url()->route('superEditCustomer',['id'=>$customer->id])}}" style="color:#555"><i
                                                            class="far fa-edit"></i> Cập Nhật</a></li>
                                            </ul>
                                        </li>
                                    </div>
                                </td>
                            </tr>   
                            @endforeach
                            
                        </table>
                        <div class="paginationx">
                            {{$customers->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="../../../../assets/js/jquery.min.js"></script>
    <script src="../../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../../assetsAdmin/js/cat.js"></script>
    <script>
        function deleteSelected(){
            if(selectedCat.length ==0) return;
            if(confirm('Bạn có chắc muốn xoá danh mục này') ){
                axios.post('{{url()->route('superDeleteEditCustomer')}}',{
                    ids:selectedCat
                }).then(d=>{
                    data = d.data
                    window.location.reload()
                })  
            }   
        }
        function filter(type){
            var trs = document.querySelectorAll('table tr')
            trs = Array.from(trs)
            trs.splice(0,1)
            if(type==0){
                trs.forEach(v=>v.style.display = 'table-row')
            }else{
                trs.forEach(v=>{
                    if(v.dataset.type==type) v.style.display = 'table-row'
                    else v.style.display = 'none'
                })
            }
        }
        function orderBy(type){
            var trs = document.querySelectorAll('#listbox table tr')
            var table = document.querySelector('#listbox table tbody')
            trs = Array.from(trs)
            html = trs[0].outerHTML
            trs.splice(0,1)
            
            if(type==0){
                trs = trs.sort((a,b)=>a.dataset.id - b.dataset.id)
            }
            if(type==1){
                trs = trs.sort((a,b)=>a.dataset.money - b.dataset.money)
            }
            if(type==2){
                trs = trs.sort((a,b)=>b.dataset.money - a.dataset.money)
            }
            if(type==3){
                trs = trs.sort((a,b)=>a.dataset.review - b.dataset.review)
            }
            trs.forEach(v=>{
                html +=v.outerHTML
            })
            table.innerHTML = html
        }
    </script>
</body>

</html>