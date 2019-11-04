<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::VuCms</title>
    <script src="../../assets/js/axios.js"></script>
</head>

<body>
    <div class="vucms">
        <div class="menubar">
            <div class="menuname">
                <span class="namehiden">
                    ADMIN-VUCMS
                </span><button id="propbar"><i class="fas fa-bars"></i></button>
            </div>
            <div class="options">
                <div class="top">
                    <div class="me">
                        <img src="{{url($user->getAvatar() ??'https://png.pngtree.com/svg/20160601/unknown_avatar_182562.png') }}"
                            alt="">
                        <div class="meme">
                            <p class="online"><span class="pointonline"></span>
                                Online</p>
                            <p class="myname">{{$user->getInfo()->name}}</p>
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
                            <li class="lv1"><a href="index.html">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span class="navtext">Bảng điều
                                        khiển</span>
                                </a>
                            </li>
                            <li class="lv1"><i class="fas fa-chart-bar"></i>
                                <span class="navtext">Quản lí</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="{{url()->route('superCategory')}}">Danh mục</a></li>
                                    <li class="lv2"><a href="{{url()->route('superProduct')}}">Sản phẩm</a></li>
                                    <li class="lv2"><a href="{{url()->route('superReview')}}">Đánh giá</a></li>
                                    <li class="lv2"><a href="{{url()->route('superSeller')}}">Nhà cung cấp</a></li>
                                    <li class="lv2"><a href="{{url()->route('superFile')}}">Files</a></li>
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
                        <img src="{{url($user->getAvatar())}}" alt="">
                        <span class="nameprofile"><span class="toptext">{{$user->getInfo()->name}}</span>
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
                            <li><i class="fas fa-sign-out-alt"></i> <a href="{{url()->route('superLogout')}}">&nbsp;
                                    Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="bottom">
                <div class="tongquan">
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{number_format($order->getTotalPrice())}}M VND
                            </p>
                            <p class="dest">
                                Tổng doanh thu
                            </p>
                        </div>
                        {{-- <span class="toprightt">
                            <span class="up">
                                <span class="percentt">6%</span> <i class="fas fa-angle-up"></i>
                            </span>
                        </span> --}}
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{number_format($order->getTotalPriceToday()['total'])}}M VND
                            </p>
                            <p class="dest">
                                Doanh thu trong ngày
                            </p>
                        </div>
                        <span class="toprightt">
                            <span class="{{$order->getTotalPriceToday()['percent']>=100 ? 'up':'down'}}">
                                <span class="percentt">{{$order->getTotalPriceToday()['percent']}}%</span> <i
                                    class="fas fa-angle-{{$order->getTotalPriceToday()['percent']>=100 ? 'up':'down'}}"></i>
                            </span>
                        </span>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$order->getNewOrderCount()['count']}}
                            </p>
                            <p class="dest">
                                Đơn hàng mới
                            </p>
                        </div>
                        <span class="toprightt">
                            <span class="{{$order->getNewOrderCount()['percent']>=100 ? 'up':'down'}}">
                                <span class="percentt">{{$order->getNewOrderCount()['percent']}}%</span> <i
                                    class="fas fa-angle-{{$order->getNewOrderCount()['percent']>=100 ? 'up':'down'}}"></i>
                            </span>
                        </span>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$order->getCompletedOrderCountToday()['count']}}
                            </p>
                            <p class="dest">
                                Đơn hàng thành công <br>
                                (Hôm nay)
                            </p>
                        </div>
                        <span class="toprightt">
                        <span class="{{$order->getCompletedOrderCountToday()['percent']>=100 ? 'up':'down'}}">
                                <span class="percentt">{{$order->getCompletedOrderCountToday()['percent']}}%</span> <i
                                    class="fas fa-angle-{{$order->getCompletedOrderCountToday()['percent']>=100 ? 'up':'down'}}"></i>
                            </span>
                        </span>
                    </div>

                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$review->getNewReviewCount()['count']}}
                            </p>
                            <p class="dest">
                                Đánh giá mới
                            </p>
                        </div>
                        <span class="toprightt">
                            <span class="{{$review->getNewReviewCount()['percent']>=100 ? 'up':'down'}}">
                                <span class="percentt">{{$review->getNewReviewCount()['percent']}}%</span> <i
                                    class="fas fa-angle-{{$review->getNewReviewCount()['percent']>=100 ? 'up':'down'}}"></i>
                            </span>
                        </span>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$traffic->getViewerMonth()['count']>1000000 ?round($traffic->getViewerMonth()['count']/1000000)."M":$traffic->getViewerMonth()['count']}}
                            </p>
                            <p class="dest">
                                Lượt truy cập <br>
                                (Tháng này)
                            </p>
                        </div>
                        <span class="toprightt">
                            <span class="{{$traffic->getViewerMonth()['percent']>=100 ? 'up':'down'}}">
                                <span class="percentt">{{$traffic->getViewerMonth()['percent']}}%</span> <i
                                    class="fas fa-angle-{{$traffic->getViewerMonth()['percent']>=100 ? 'up':'down'}}"></i>
                            </span>
                        </span>
                    </div>
                </div>

                <div class="chart_number">
                    <div class="chart">
                        <div class="charttitle">
                            <span class="chartext">Biểu Đồ Thống Kê</span>
                            <div class="monthcontrol">
                                <button id="prev"><i class="fas fa-angle-left"></i></button>
                                Tháng <span class="cmonth">{{date('m')}}</span>
                                <button id="next"><i class="fas fa-angle-right"></i></button>
                            </div>
                        </div>
                        <div style="height:100%;display:flex;
                                                            align-items: center;padding:10px;"><canvas
                                id="myChart"></canvas></div>
                    </div>
                    <div class="number">
                        <div class="groupcircle">
                            <div class="circle">
                                <p class="title">
                                    Danh Mục Sản phẩm
                                </p>
                                <div class="chartarea">
                                    <canvas id="circlechart"></canvas>
                                </div>
                            </div>
                            <div class="circle">
                                <p class="title">
                                    Đánh Giá
                                </p>
                                <div class="chartarea">
                                    <canvas id="circlechart1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="newuser">
                            <div class="usertitle">
                                <p class="usertext">Khách hàng mới</p>
                            </div>
                            <div class="tabuser">
                                <table>
                                    <tr>
                                        <th></th>
                                        <th>Tên</th>
                                        @if ($user->role_id==1)
                                        <th>Email</th>
                                        @endif
                                        <th>Ngày tham gia</th>
                                        <th></th>
                                    </tr>
                                    @foreach ($lastCustomers as $customer)
                                    <tr>
                                        <td><img src="{{url($customer->getAvatar())}}" alt="" class="avtuser"></td>
                                        <td>{{$customer->name}}</td>
                                        @if ($user->role_id==1)
                                        <td>{{$customer->User()->email}}</td>
                                        @endif
                                        <td>{{$customer->create_at}}</td>
                                        <td><a href="{{url()->route('superEditCustomer',['id'=>$customer->id])}}"><button
                                                style="background:transparent;border:none;outline:none"><i
                                                    class="far fa-eye" style="color:#9aa0ac"></i></button></a></td>
                                    </tr>
                                    @endforeach
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($user->role_id==1)
                <div class="tongquan traffic">
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$user->getCountOnline()}}
                            </p>
                            <p class="dest">
                                Người dùng Online
                            </p>
                        </div>
                    </div>
                    <div class="totalitem" style="background-image: linear-gradient(to right, #0ac282, #0df3a3);">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$traffic->getTotalView()}}
                            </p>
                            <p class="dest">
                                Tổng lượt xem
                            </p>
                        </div>
                    </div>
                    <div class="totalitem" style="background-image:linear-gradient(to right, #fe5d70, #fe909d);">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$traffic->getSessionLoginCount()}}
                            </p>
                            <p class="dest">
                                Phiên Đăng Nhập
                            </p>
                        </div>
                    </div>
                    <div class="totalitem" style="background-image:linear-gradient(to right, #01a9ac, #60e2e4);">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$traffic->getAvgTimeSession() > 60 ? round($traffic->getAvgTimeSession()/60).' Phút': $traffic->getAvgTimeSession().' Giây'}}
                            </p>
                            <p class="dest">
                                Thời gian trung bình của phiên
                            </p>
                        </div>
                    </div>

                    <div class="totalitem" style="background-image:linear-gradient(to right, #9857b4, #c8a7d6);">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$traffic->getNewSessionLoginCount()['count']}}
                            </p>
                            <p class="dest">
                                Phiên Đăng Nhập Mới
                            </p>
                        </div>
                        <span class="toprightt">
                            <span class="{{$traffic->getNewSessionLoginCount()['percent']>=100 ? 'up':'down'}}">
                                <span class="percentt">{{$traffic->getNewSessionLoginCount()['percent']}}%</span> <i
                                    class="fas fa-angle-{{$traffic->getNewSessionLoginCount()['percent']>=100 ? 'up':'down'}}"></i>
                            </span>
                        </span>
                    </div>
                    <div class="totalitem" style="background-image:linear-gradient(to right, #ffcc02, #ffdf5f);">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$traffic->getCountLogout()}}
                            </p>
                            <p class="dest">
                                Lượt Đăng Xuất
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="extrabox">
                    <div class="useractions">
                        <div class="extratitle">
                            <p class="extratext">Lịch sử hoạt động</p>
                        </div>
                        
                        <div class="actionlist">
                            <ul class="actions">
                                @foreach ($lastActions as $action)
                                <li class="act">
                                    <img src="{{url($action->User()->getAvatar())}}" alt="" class="actavt">
                                    <span class="acttext"><span class="actname"><a href="{{url()->route('superEditCustomer',['id'=>$action->Customer()->id])}}">{{$action->Customer()->name}}</a>:</span> Lorem
                                        {{$action->message}} <br>
                                    </span>
                                    <span class="acttime"><i class="far fa-clock"></i> {{Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($action->created_at,'Asia/Ho_Chi_Minh')) <60 ? Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($action->created_at,'Asia/Ho_Chi_Minh')).' phút' : Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInHours(Carbon\Carbon::parse($action->created_at,'Asia/Ho_Chi_Minh')).' giờ'}}  trước</span>
                                </li> 
                                @endforeach
                                
                            </ul>
                            <p class="viewmore"><a href="{{url()->route('history')}}">Xem tất cả hoạt động <i
                                        class="fas fa-arrow-right"></i></a></p>
                        </div>
                    </div>
                    <div class="orderlist">
                        <div class="extratitle">
                            <p class="extratext">Đơn hàng</p>
                        </div>
                        <div class="ordertab">
                            <table class="ordertabler">
                                <tr>
                                    <th>MÃ ĐƠN HÀNG</th>
                                    <th>THÀNH TIỀN</th>
                                    <th>KHÁCH HÀNG</th>
                                    <th>ĐƠN VỊ VẬN CHUYỂN</th>
                                    <th>CẬP NHẬT LẦN CUỐI</th>
                                    <th>TRẠNG THÁI</th>
                                    <th>THANH TOÁN</th>
                                    <th></th>
                                </tr>
                                @foreach ($lastOrders as $order)
                                    
                                <tr>
                                    <td><a href="{{url()->route('superEditOrder',['slug'=>$order->slug])}}" class="tabname">{{$order->slug}}</a></td>
                                    <td>{{number_format($order->total)}} đ</td>
                                    <td><a href="{{url()->route('superEditCustomer',['id'=>$order->Customer()->id])}}" class="tabcus">{{$order->Customer()->name}}</a></td>
                                    <td><a href="{{url()->route('superEditShipper',['id'=>$order->getShipper()->id])}}" class="tabcus">{{$order->getShipper()->name}}</a></td>
                                    <td>{{Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($order->updated_at,'Asia/Ho_Chi_Minh')) <60 ? Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($order->updated_at,'Asia/Ho_Chi_Minh')).' phút' : Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInHours(Carbon\Carbon::parse($order->updated_at,'Asia/Ho_Chi_Minh')).' giờ'}}  trước</td>
                                    <td>
                                        <div class="tabstt">
                                            @switch($order->status)
                                                @case(1)
                                                    <span class="point" id="com"></span>
                                                    <span class="stttext">Chờ xác nhận</span>
                                                    @break
                                                @case(2)
                                                    <span class="point" id="pen"></span>
                                                    <span class="stttext">Chờ lấy hàng</span>
                                                    @break
                                                @case(3)
                                                    <span class="point" id="pen"></span>
                                                    <span class="stttext">Đang giao</span>
                                                    @break
                                                @case(4)
                                                    <span class="point" id="com"></span>
                                                    <span class="stttext">Thành công</span>
                                                    @break
                                                @case(5)
                                                    <span class="point" id="not"></span>
                                                    <span class="stttext">Đã huỷ</span>
                                                    @break
                                                @default
                                                    
                                            @endswitch
                                        </div>
                                    </td>
                                    <td>12M</td>
                                    <td><a href="{{url()->route('superEditOrder',['slug'=>$order->slug])}}" class="tabmanage"><button class="tabbtn"><i class="fas fa-edit"></i></button></a> </td>
                                </tr>
                                @endforeach
                                
                            </table>
                        </div>
                        <p class="viewmore"><a href="{{url()->route('superOrder')}}">Xem tất cả đơn hàng <i
                                    class="fas fa-arrow-right"></i></a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>

        var labels = [];
        var datas = []
        var dataview = [];
        MoneyData = JSON.parse('{!!$order->getMoneyEachDay(date('m'))!!}');
        ViewData = JSON.parse('{!!$traffic->getViewEachDay(date('m'))!!}');
        MoneyData.forEach((money) => {
            labels.push('Ngày ' + money.day)
            datas.push(money.money / 1000000)
        })
        ViewData.forEach(view => {
            dataview.push(view.view / 1000)
        })
    </script>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/index.js"></script>
    <script>
        $('.monthcontrol #prev').click(() => {
            if (parseInt($('.cmonth').html()) > 1) {
                chart.data.datasets[0].data = []
                chart.data.datasets[1].data = []
                chart.data.labels = []
                let nextMonth = parseInt($('.cmonth').html()) - 1;
                axios.post('{{url()->route('getMoneyEachDay')}}', {
                    month: nextMonth
                }).then(data => {
                    MoneyData = data.data;
                    MoneyData.forEach((money) => {
                        chart.data.labels.push('Ngày ' + money.day)
                        chart.data.datasets[0].data.push(money.money / 1000000)
                    })
                    chart.update()
                })
                axios.post('{{url()->route('getViewEachDay')}}', {
                    month: nextMonth
                }).then(data => {
                    ViewData = data.data;
                    ViewData.forEach((view) => {
                        chart.data.datasets[1].data.push(view.view / 1000)
                    })
                    chart.update()
                })

                $('.cmonth').html(nextMonth)
            }
        })
        $('.monthcontrol #next').click(() => {
            if (parseInt($('.cmonth').html()) < 12) {
                chart.data.datasets[0].data = []
                chart.data.datasets[1].data = []
                chart.data.labels = []
                let nextMonth = parseInt($('.cmonth').html()) + 1;
                axios.post('{{url()->route('getMoneyEachDay')}}', {
                    month: nextMonth
                }).then(data => {
                    MoneyData = data.data;
                    MoneyData.forEach((money) => {
                        chart.data.labels.push('Ngày ' + money.day)
                        chart.data.datasets[0].data.push(money.money / 1000000)
                    })
                    chart.update()
                })
                axios.post('{{url()->route('getViewEachDay')}}', {
                    month: nextMonth
                }).then(data => {
                    ViewData = data.data;
                    ViewData.forEach((view) => {
                        chart.data.datasets[1].data.push(view.view / 1000)
                    })
                    chart.update()
                })

                $('.cmonth').html(nextMonth)
            }
        })


        dataCategories = JSON.parse('{!!$category->getCountEachCategory()!!}')
        labelsCat = dataCategories.map(cat=>cat.name)
        dataCat = dataCategories.map(cat=>cat.count)
        colorCat = dataCategories.map(cat=>'rgb('+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+')')
        var myPieChart = new Chart(circlechart, {
            type: 'doughnut',
            data: {
                labels: labelsCat,
                datasets: [
                    {
                        label: "null",
                        data: dataCat,
                        backgroundColor: colorCat,
                        borderColor: [
                            "white"
                        ],
                        borderWidth: [0.5]
                    }
                ]
            },

            options: {
                legend: {
                    display: false
                },
                responsive: true
            }
        });
        dataReview = JSON.parse('{!!$review->getCountEachStar()!!}')
        dataRv = []
        for(i=5;i>=1;i--){
            let c = dataReview.filter((rv)=>rv.star==i)[0];
            dataRv.push(c===undefined ? 0 : c.count);
        }
        var circlechart = document.getElementById("circlechart1");
        var myPieChart = new Chart(circlechart, {
            type: 'doughnut',
            data: {
                labels: [' Rất Tốt (5 sao)',
                    ' Tốt (4 sao)',
                    ' Được (3 sao)',
                    ' Tệ (2 sao)',
                    ' Rất Tệ (1 sao)'
                ],
                datasets: [
                    {
                        label: "null",
                        data: dataRv,
                        backgroundColor: [
                            'rgb('+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+')',
                            'rgb('+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+')',
                            'rgb('+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+')',
                            'rgb('+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+')',
                            'rgb('+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+','+Math.ceil(Math.random()*255)+')'
                        ],
                        borderColor: [
                            'white'
                        ],
                        borderWidth: [0.5]
                    }
                ]

            },

            options: {
                legend: {
                    display: false
                }
            }
        });
//chartcontrolmonth
    </script>
</body>

</html>