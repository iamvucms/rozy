<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/cat.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/order.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../assetsAdmin/css/chart.min.css">
    <script src="../../assets/js/axios.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Orders</title>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right" style="position:relative">
            @include('includes.top')
            <div class="bottom">
                <div class="headtitle">
                    <p>ĐƠN HÀNG</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Đơn Hàng</a></span></li>

                        </ul>
                    </div>

                </div>
                @php
                    $obj = new App\Order;    
                @endphp
                <div class="tongquan tabcat">
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$obj->count()}}
                            </p>
                            <p class="dest">
                                Tổng Đơn Hàng
                            </p>
                        </div>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{number_format($obj->getTotalValue())}}M <sup>VND</sup>
                            </p>
                            <p class="dest">
                                Tổng Giá Trị
                            </p>
                        </div>
                        
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt" style="color:#5eba00">
                                {{$obj->getCountCompletedOrder()}}
                            </p>
                            <p class="dest">
                                Đơn Hàng Thành Công
                            </p>
                        </div>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$obj->getCountWaitingOrder()}}
                            </p>
                            <p class="dest">
                                Đơn Hàng Chờ Xác Nhận
                            </p>
                        </div>
                    </div>

                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt" style="color:red">
                                {{$obj->getCountCancelOrder()}}
                            </p>
                            <p class="dest">
                                Đơn hàng đã hủy
                            </p>
                        </div>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$obj->getCountDeliveringOrder()}}
                            </p>
                            <p class="dest">
                                Đơn hàng đang giao
                            </p>
                        </div>
                    </div>
                </div>
                <div class="catlist">
                    <div class="cattitle">
                        <span><i class="fas fa-list-ul"></i> Tất Cả Đơn Hàng</span>
                        <ul class="catright">
                            <li><i class="fas fa-filter"></i> Tất Cả <i class="fas fa-angle-down"></i>
                                <ul>
                                    <li onclick="filter(0)">tất cả</li>
                                    <li onclick="filter(1)">chờ xác nhận</li>
                                    <li onclick="filter(2)">chờ lấy hàng</li>
                                    <li onclick="filter(3)">đang vận chuyển</li>
                                    <li onclick="filter(4)">đã giao</li>
                                    <li onclick="filter(5)">đã hủy</li>
                                </ul>
                            </li>
                            <li><i class="fas fa-sort-amount-up"></i> Sắp Xếp <i class="fas fa-angle-down"></i>
                                <ul>
                                    <li onclick="orderBy(0)">Mặc định</li>
                                    <li onclick="orderBy(1)"><i class="fas fa-sort-amount-up"></i> Giá trị </li>
                                    <li onclick="orderBy(2)"><i class="fas fa-sort-amount-down"></i> Giá trị </li>
                                    <li onclick="orderBy(3)"><i class="far fa-clock"></i> Phí ship</li>
                                </ul>
                            </li>
                            <li><i class="fas fa-radiation"></i> Thao Tác <i class="fas fa-angle-down"></i>
                                <ul>
                                    <li onclick="acceptOrder()"><i class="fas fa-plus-circle"></i>
                                            Duyện đơn</li>
                                    @if($user->role_id==1) <li onclick="deleteSelected()"><i class="far fa-trash-alt"></i> Xóa</li> @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="tabcat taborder" id="listbox">
                        <table border="1">
                            <tr>
                                <th></th>
                                <th>MHD</th>
                                <th>Tên khách hàng</th>
                                <th>Đơn vị vận chuyển</th>
                                <th>Nhà cung cấp</th>
                                <th>Giá trị</th>
                                <th>Phí Ship</th>
                                <th>Giảm Giá</th>
                                <th>Trạng thái</th>
                                <th>Thời Gian khởi tạo</th>
                                <th>cập nhật lần cuối</th>
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($orders as $order)
                            <tr data-id="{{$order->id}}" data-type="{{$order->status}}" data-money="{{$order->total}}" data-ship="{{$order->ship_price}}">
                                    <td><input data-idcat="{{$order->id}}" type="checkbox" id="check"></td>
                                        <td>{{$order->slug}}</td>
                                    <td><a href="{{url()->route('superEditCustomer',['id'=>$order->RlCustomer->id])}}">{{$order->RlCustomer->name}}</a></td>
                                    <td><a href="{{url()->route('superEditShipper',['id'=>$order->Shipper->id])}}">{{$order->Shipper->name}}</a></td>
                                    <td><a href="{{url()->route('superEditSeller',['id'=>$order->Seller->id])}}">{{$order->Seller->name}}</a></td>
                                    <td>{{number_format($order->total)}} VND</td>
                                    <td>{{number_format($order->ship_price)}} VND</td>
                                    <td>- {{number_format($order->coupon_price)}} VND</td>
                                    <td>
                                        <div class="tabstt">
                                            @switch($order->status)
                                                @case(1)
                                                    <span class="point" id="pen"></span>
                                                    <span class="stttext">Chờ xác nhận</span>
                                                    @break
                                                @case(2)
                                                    <span class="point" id="pen"></span>
                                                    <span class="stttext">Chờ lấy hàng</span>
                                                    @break
                                                @case(3)
                                                    <span class="point" id="pen"></span>
                                                    <span class="stttext">Đang Giao</span>
                                                    @break
                                                @case(4)
                                                    <span class="point" id="com"></span>
                                                    <span class="stttext">Đã Giao</span>
                                                    @break
                                                @case(5)
                                                    <span class="point" id="not"></span>
                                                    <span class="stttext">Đã Huỷ</span>
                                                    @break
                                                @default
                                                    
                                            @endswitch
                                        </div>
                                    </td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($order->updated_at,'Asia/Ho_Chi_Minh')) <60 ? Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($order->updated_at,'Asia/Ho_Chi_Minh')).' phút' : Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInHours(Carbon\Carbon::parse($order->updated_at,'Asia/Ho_Chi_Minh')).' giờ'}}  trước</td>
                                    <td>
                                        <div class="lasttd">
                                            <a href="#" target="__blank"><button><i class="far fa-eye"></i></button></a>
                                            <li id="showoption"><i class="fas fa-angle-down"></i>
                                                <ul>
                                                    <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                    <li><a href="{{url()->route('superAcceptOrder',['id'=>$order->id])}}" style="color:#555"><i
                                                                class="far fa-edit"></i> Duyệt</a></li>
                                                    <li><a href="print.html" style="color:#555" target="__blank"><i
                                                                class="fas fa-print"></i> In đơn hàng</a></li>
                                                    <li><a href="print.html" style="color:#555" target="__blank"><i
                                                                class="far fa-file-powerpoint"></i> In đơn vận chuyển</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="paginationx">
                            {{$orders->links()}}
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
            if(confirm('Bạn có chắc muốn xoá đơn hàng này') ){
                axios.post('{{url()->route('superDeleteEditOrder')}}',{
                    ids:selectedCat
                }).then(d=>{
                    data = d.data
                    window.location.reload()
                })  
            }   
        }
        function acceptOrder(){
            if(selectedCat.length ==0) return;
            if(confirm('Bạn có chắc muốn duyệt đơn hàng này') ){
                axios.post('{{url()->route('superAcceptOrder')}}',{
                    ids:selectedCat
                }).then(d=>{
                    data = d.data
                    window.location.reload()
                })  
            }   
        }
        function postDelete(id){
            if(confirm('Bạn có chắc muốn xoá danh mục này') ){
                axios.post('{{url()->route('superDeleteEditCustomer')}}',{
                    ids:[id]
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
                trs = trs.sort((a,b)=>-(a.dataset.ship - b.dataset.ship))
            }
            trs.forEach(v=>{
                html +=v.outerHTML
            })
            table.innerHTML = html
        }
    </script>
</body>

</html>