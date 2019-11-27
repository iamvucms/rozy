<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::VuCms</title>
    <script src="../../assets/js/socket.io.js"></script>
    <script src="../../assets/js/axios.js"></script>
</head>

<body>
    <div class="vucms">
    @if(isset($messages) && $user->role_id==3)
		<div class="inbox" id="notactive">
			<p class="intitle" style="margin:0px!important"><i class="far fa-comment-alt"></i> Trò Chuyện
				<div class="boxchat">
					<div class="listuser">
						<div class="toptool" style="border-radius:10px 0 0 0;color:white">
							Danh Sách
						</div>
						<ul id="sellerlist">
							
							@php
							$MsgSellers = $messages->myCustomers($user->Seller()->id);
							
							@endphp
							@foreach ($MsgSellers as $cus)
							<li @if($cus==$MsgSellers->first()) class="active" @endif 
							data-name="{{$cus->Customer->name}}"
							data-user="{{$cus->Customer->user_id}}"
							data-customer="{{$cus->Customer->id}}" data-user="{{$cus->Customer->user_id}}" 
							data-avatar="{{url($cus->Customer->Image->src ?? '')}}">
							{{$cus->Customer->name}}</li>
							@endforeach
							
						</ul>
					</div>
					
					<div class="preboxchat">
						<div class="toptool"><span class="centername">Khách Hàng: {{$MsgSellers->first()->Customer->name}}</span> <button
								class="closechat">×</button></div>
						<div class="chatlist">
							<div class="scrolllog">
								<ul id="chatlog" data-current="{{$MsgSellers->first()->Customer->user_id}}">
									@foreach ($messages->getMessagesBySeller($MsgSellers->first()->Customer->id,$user->Seller()->id) as $msg)
                                        @if($msg->position==1) 
                                        <li class="left">
                                            <img src="{{url($MsgSellers->first()->Customer->Image->src ?? '')}}" alt="" class="avtsend">
                                            <p class="msgcontent">{{$msg->msg}}</p>
                                        </li>
										@else
										<li class="right">
                                            <p class="msgcontent">{{$msg->msg}}</p>
                                        </li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
						<div class="send">
							<input id="msgTxt" type="text" onkeypress="CheckEnter(event)" placeholder="Nhập tin nhắn">
							<button id="sendMsg"><i class="far fa-paper-plane"></i></button>
						</div>
					</div>
				</div>
			</p>

		</div>
		<script>
			function CheckEnter(e){
				if(e.keyCode==13) SendNow()
			}
			function SendNow(){
				txtInp = document.querySelector('#msgTxt')
				if(txtInp.value!=''){
					let to =document.querySelector('#chatlog').dataset.current
					SendMessage(txtInp.value,{{$user->id}},to,2)
					html = `<li class="right">
								<p class="msgcontent">${document.querySelector('#msgTxt').value}</p>
							</li>`
					txtInp.value = ''
					document.querySelector('#chatlog').innerHTML = document.querySelector('#chatlog').innerHTML+html
					$(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 1000);
				}
			}
			document.querySelector('#sendMsg').onclick = SendNow
			document.querySelectorAll('#sellerlist li').forEach(v=>{
				v.onclick = (e)=>{
					document.querySelectorAll('#sellerlist li').forEach(x=>{
							x.classList.remove('active')
					})
					v.classList.add('active')
					axios.post('{{url()->route('getMsgByCustomer')}}',{
						idcus:v.dataset.customer
					}).then(d=>{
                        data = d.data
						if(data.success){
                            document.querySelector('.toptool .centername').innerHTML='Khách Hàng: '+v.dataset.name
                            document.querySelector('#chatlog').setAttribute('data-current',v.dataset.user)
                            msg = data.data
                            console.log(msg)
                            html = ''
                            for(let m of msg){
                                if(m.position==2) html += `<li class="right">
                                                <p class="msgcontent">${m.msg}</p>
                                            </li>`;
                                else html += `<li class="left">
                                                <img src="${v.dataset.avatar}" alt="" class="avtsend">
                                                <p class="msgcontent">${m.msg}</p>
                                            </li>`
                            }
                            document.querySelector('#chatlog').innerHTML = html
                            $(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 300);
                        }
					})
				}
			})
		</script>
		@endif
        @include('includes.menubar')
        <div class="right">
            @include('includes.top')
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
                                        <td>{{$customer->User->first()->email}}</td>
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
                                    <span class="acttime"><i class="far fa-clock"></i> {{Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($action->created_at,'Asia/Ho_Chi_Minh')) <60 ? Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($action->created_at,'Asia/Ho_Chi_Minh')).' phút' : (Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInHours(Carbon\Carbon::parse($action->created_at,'Asia/Ho_Chi_Minh'))<24?Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInHours(Carbon\Carbon::parse($action->created_at,'Asia/Ho_Chi_Minh')).' giờ':Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInDays(Carbon\Carbon::parse($action->created_at,'Asia/Ho_Chi_Minh')).' ngày')}}  trước</span>
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
                                    <td><a href="{{url()->route('superGetOrder',['id'=>$order->id])}}" class="tabname">{{$order->slug}}</a></td>
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
                                    <td><a href="{{url()->route('superGetOrder',['id'=>$order->id])}}" class="tabmanage"><button class="tabbtn"><i class="fas fa-edit"></i></button></a> </td>
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
    <script src="../../../assets/js/socket.init.js"></script>

    <script>
        var　getMsgURI='{{url()->route('getMsgByCustomer')}}';
        @if($user->role_id==3)
		socketAuth({{$user->id}},2,'{{$user->password}}')
		@endif
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