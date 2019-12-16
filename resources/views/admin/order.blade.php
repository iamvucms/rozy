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
    <script src="../../../assets/js/socket.io.js"></script>
    <script src="../../../assets/js/socket.init.js"></script>
    <link rel="stylesheet" href="../../../assets/css/all.css"
        >
    <title>Admin::Orders</title>
</head>

<body>
    <div class="vucms">
        @if(isset($messages) && $user->role_id==3 && $messages->myCustomers($user->Seller()->id)->count()>0)
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
        <div class="right" style="position:relative">
            <div class="detailBox">
                <div class="box" >
                    <h2>Thông Tin Chi Tiết Đơn Hàng</h2>
                    <table class="probox" border="1">
                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Giá gốc</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                        <tr>
                            <td>a</td>
                            <td><img src="" alt=""></td>
                            <td><a href=""></a></td>
                            <td>a</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button onclick=""><i class="fal fa-trash-alt"></i> Xoá</button></td>
                        </tr>
                    </table>
                    <div class="detail">
                        <div class="col1">
                            <h3>Thông tin người nhận</h3>
                                <span>Họ và tên: </span><b id="dtname">aaaa</b> <br>
                                <span>Điện thoại: </span><b id="dtphone">aaa</b><br>
                                <span>Địa chỉ: </span><b id="dtaddress">aa</b><br>
                                <span>Thanh toán: </span><b id="dtpay">aa</b><br>
                        </div>
                        <div class="col2">
                            <h3>Thông tin người nhận</h3>
                            <table border="1">
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <td id="dtProductPrice">q</td>
                                </tr>
                                <tr>
                                    <td>Vận chuyển-<span id="dtship"></span></td>
                                    <td id="dtshipMoney">q</td>
                                </tr>
                                <tr>
                                    <td>Mã Giảm Giá:</td>
                                    <td id="dtCoupon">q</td>
                                </tr>
                                <tr>
                                    <td>Tổng cộng</td>
                                    <td id="dtAllPrice">q</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
                                            <a href="javascript:void(0)" onclick="showDetail({{$order->id}})"><button><i class="far fa-eye"></i></button></a>
                                            <li id="showoption"><i class="fas fa-angle-down"></i>
                                                <ul>
                                                    <li><i class="far fa-trash-alt"></i> Xóa</li>
                                                    <li><a href="{{url()->route('supergetAcceptOrder',['id'=>$order->id])}}" style="color:#555"><i
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
        document.querySelector('.detailBox').onclick = e=>{
            if(e.target.className=='detailBox') document.querySelector('.detailBox').style.display ='none'
        }
        function showDetail(id){
            axios.post('{{url()->route('superGetOrderDetail')}}',{
                    id:id
                }).then(d=>{
                    data = d.data
                    if(data.success){
                        
                        box = document.querySelector('.detailBox')
                        table = document.querySelector('.detailBox table tbody')
                        tr = document.querySelectorAll('.detailBox table tr')
                        ar = Array.from(tr);
                        html = ar[0].outerHTML
                        order = data.data[0]
                        console.log(order)
                        let paytext = '';
                        switch (order.pay_type) {
                            case 1:
                                paytext = 'Thanh toán Visa/MasterCard'
                                break;
                            case 2:
                                paytext = 'Thanh toán qua chuyển khoản'
                                break;
                            case 3:
                                paytext = 'Thanh toán khi nhận hàng'
                                break;
                            
                        }
                        document.querySelector('#dtphone').innerHTML = order.phone
                        document.querySelector('#dtaddress').innerHTML = order.address
                        document.querySelector('#dtpay').innerHTML = paytext
                        document.querySelector('#dtname').innerHTML = order.name
                        document.querySelector('#dtCoupon').innerHTML = "-"+(new Intl.NumberFormat('ja-JP').format(order.coupon_price))+" VND"
                        document.querySelector('#dtship').innerHTML = order.shipper.name
                        document.querySelector('#dtshipMoney').innerHTML = (new Intl.NumberFormat('ja-JP').format(order.ship_price))+" VND"
                        document.querySelector('#dtAllPrice').innerHTML = (new Intl.NumberFormat('ja-JP').format(order.total))+" VND"
                        productprice = 0
                        order.order_details.forEach(odd=>{
                            let product = odd.product
                            
                            html+= '<tr><td>'+product.id+'</td><td><img width="80" height="80" src="{{url('/')}}'+product.img_avt.src+'"></td><td>'+product.name+'</td><td>'+(new Intl.NumberFormat('ja-JP').format(product.sale_price))+' VND</td><td>'+(new Intl.NumberFormat('ja-JP').format(product.price))+' VND</td><td>'+odd.quantity+'</td><td>'+(new Intl.NumberFormat('ja-JP').format(product.sale_price*odd.quantity))+' VND</td><td><button onclick="RemoveProduct('+order.id+','+product.id+',this)"><i class="fal fa-trash-alt"></i> Xoá</button></td></tr>'
                        })
                        document.querySelector('#dtProductPrice').innerHTML = (new Intl.NumberFormat('ja-JP').format(productprice))+" VND"
                        table.innerHTML = html;
                        box.style.display = 'block'
                    }
                })  
        }
        function deleteSelected(){
            if(selectedCat.length ==0) return;
            if(confirm('Bạn có chắc muốn xoá '+selectedCat.length+' đơn hàng này') ){
                axios.post('{{url()->route('superDeleteEditOrder')}}',{
                    ids:selectedCat
                }).then(d=>{
                    data = d.data
                    window.location.reload()
                })  
            }   
        }
        function RemoveProduct(idorder,idproduct,btn){
            if(confirm('Bạn có chắc muốn xoá sản phẩm này khỏi đơn hàng') ){
                axios.post('{{url()->route('superDeleteOrderDetail')}}',{
                    idorder:idorder,
                    idproduct:idproduct
                }).then(d=>{
                    data = d.data
                    if(data.success){
                        if(data.isF5) window.location.reload()
                        else{
                            btn.parentElement.parentElement.outerHTML = ''
                        }
                    }
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
        var　getMsgURI='{{url()->route('getMsgByCustomer')}}';
        $('.inbox .intitle').click(() => {
            $('.inbox').attr('id', 'active')
            $('.boxchat').css('display', 'flex')
            $(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 1000);
        })
        $('.closechat').click(() => {
    
            $('.boxchat').hide()
            $('.inbox').attr('id', 'notactive')
        })
        @if($user->role_id==3)
			socketAuth({{$user->id}},2,'{{$user->password}}')
		@endif
    </script>
</body>

</html>