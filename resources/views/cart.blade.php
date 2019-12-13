<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giỏ Hàng Của Bạn</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/slide.min.css">
    <link rel="stylesheet" href="assets/css/slide.theme.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.theme.min.css">
    <script src="../assets/js/axios.js"></script>
</head>

<body>
    <div class="rozy">
    @if(isset($messages) && $user && $messages->mySellers($user->getInfo()->id)->count()>0)
		<div class="inbox" id="notactive">
			<p class="intitle"><i class="far fa-comment-alt"></i> Trò Chuyện
				<div class="boxchat">
					<div class="listuser">
						<div class="toptool" style="border-radius:10px 0 0 0;color:white">
							Danh Sách
						</div>
						<ul id="sellerlist">
							
							@php
							$MsgSellers = $messages->mySellers($user->getInfo()->id);
							
							@endphp
							@foreach ($MsgSellers as $slr)
							<li @if($slr==$MsgSellers->first()) class="active" @endif 
							data-name="{{$slr->Seller->name}}"
							data-user="{{$slr->Seller->user_id}}"
							data-seller="{{$slr->Seller->id}}" data-user="{{$slr->Seller->user_id}}" 
							data-avatar="{{url($slr->Seller->Avatar->src ?? '')}}">
							{{$slr->Seller->name}}</li>
							@endforeach
							
						</ul>
					</div>
					
					<div class="preboxchat">
						<div class="toptool"><span class="centername">SHOP: {{$MsgSellers->first()->Seller->name}}</span> <button
								class="closechat">×</button></div>
						<div class="chatlist">
							<div class="scrolllog">
								<ul id="chatlog" data-current="{{$MsgSellers->first()->Seller->user_id}}">
									@foreach ($messages->getMessagesBySeller($user->getInfo()->id,$MsgSellers->first()->Seller->id) as $msg)
										@if($msg->position==1) 
										<li class="right">
											<p class="msgcontent">{{$msg->msg}}</p>
										</li>
										@else
										<li class="left">
											<img src="{{url($MsgSellers->first()->Seller->Avatar->src ?? '')}}" alt="" class="avtsend">
											<p class="msgcontent">{{$msg->msg}}</p>
										</li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
						<div class="send">
							<input id="msgTxt" onkeypress="CheckEnter(event)" type="text" placeholder="Nhập tin nhắn">
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
					SendMessage(txtInp.value,{{$user->id}},to)
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
					axios.post('{{url()->route('getMsgBySeller')}}',{
						idsell:v.dataset.seller
					}).then(d=>{
						data = d.data
						document.querySelector('.toptool .centername').innerHTML='SHOP: '+v.dataset.name
						document.querySelector('#chatlog').setAttribute('data-current',v.dataset.user)
						msg = data.data
						html = ''
						for(let m of msg){
							if(m.position==1) html += `<li class="right">
											<p class="msgcontent">${m.msg}</p>
										</li>`;
							else html += `<li class="left">
											<img src="${v.dataset.avatar}" alt="" class="avtsend">
											<p class="msgcontent">${m.msg}</p>
										</li>`
						}
						document.querySelector('#chatlog').innerHTML = html
						$(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 300);
					})
				}
			})
			$(document).ready(()=>{
				$('.inbox p.intitle').click(() => {
					$('.inbox').attr('id', 'active')
					$('.boxchat').css('display', 'flex')
					$(".chatlist").animate({ scrollTop: $('.scrolllog').height() }, 1000);
				})
				$('.closechat').click(() => {
				
					$('.boxchat').hide()
					$('.inbox').attr('id', 'notactive')
				})
			})
		</script>
		@endif
        <!-- header -->
        <div class="header">

            <div class="topinfo">
                <span style="margin-left:18%"><i class="fas fa-map-marker-alt"></i> 123 Nam Ky Khoi Nghia, Da
                    Nang</span>
                <span style="margin-left:300px"><i class="fas fa-phone"></i> +84 766 730 945 | Support: 0236 456 789 |
                    Sales: 0236 456 710</span>
            </div>
            <!-- boxtop -->
            <div class="boxtop">
                <!-- boxtopmain -->
                <div class="boxtopmain">
                    <div class="centerboxtop">
                        <div class="logo">
                            <i class="fas fa-cart-arrow-down"></i>
                            <span class="logoname"> Rozy.</span>
                        </div>
                        <div class="mobilelogo"><a href="filter.html"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <!-- boxsearch -->
                        <div class="boxsearch">
                            <form action="{{url('/search')}}">
                                <input autocomplete="off" name="keyword" placeholder="Nhập từ khóa sản phẩm..."
                                    type="search" class="searchinput"><button onclick=""
                                    class="searchnow micnow"><span><i class="fas fa-microphone"></i></span></button>
                                <select name="cat" type="text" id="category_select">
                                    <option value="0" selected=selected>Tất cả danh mục</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select><button class="searchnow"><span><i class="fas fa-search"></i><span
                                            id="search_none">Tìm
                                            kiếm</span></span></button>
                                <div class="boxmic">
                                    <p><span id="gifload"><i class="fas fa-spinner"></i></span>
                                        <span id="micicon"><i class="fas fa-microphone-alt"></i><span>Hãy Nói Từ Khóa
                                                Cần Tìm </span></span>
                                    </p>
                                </div>
                            </form>
                            <div class="ideaforsearch">
								<p class="ideatitle">
									Gợi Ý Cho Bạn:
								</p>
								<ul id="idealist">
									@for ($i = count($recommandProducts)-1; $i >= count($recommandProducts)-11 ; $i--)
									<li><a href="{{url()->route('myProduct',['slug'=>$recommandProducts[$i]['slug']])}}"><img src="{{url($recommandProducts[$i]->ImgAvt->src??'')}}"><span>{{$recommandProducts[$i]->name}}</span></a>
									</li>
									@endfor
									
								</ul>
								<p class="ideatitle">
									Từ Khóa Hot:
								</p>
								<ul id="hotkeyidea">
									@foreach ($mostedKeyword[0] as $index => $key)
									<li><a href="{{url()->route('filter',['keyword'=>urlencode($key['keyword'])])}}">{{$key['keyword']}}</a></li>
									@endforeach
								</ul>
							</div>
                            <p>GIỎ HÀNG</p>
                        </div>
                        <div class="mobliecart" id="tools">
                            <i class="fas fa-ellipsis-v">
                                <span>
                                    <li><a href="#"><i class="fas fa-user-circle"></i> Tài khoản</a></li>
                                    <li><a href="#"><i class="fas fa-bell"></i> Thông báo</a></li>
                                    <li><a href="#"><i class="fas fa-clipboard-check"></i> Theo dõi đơn hàng</a></li>
                                    <li><a href="#"><i class="fas fa-shopping-basket"></i> Mua hàng</a></li>
                                </span>
                            </i>
                        </div>
                        <!-- endboxsearch -->
                        <!-- rightoption  -->
                        <div class="sales">
                            <li class="saleoption">
                                <i class="fab fa-hotjar"></i>
                                Khuyến mãi <sup id="salepercent">-5%</sup>
                            </li>
                        </div>
                        @if ($user)
                        <div class="rightoptions">
                            <li class="roption">
                                <i class="fas fa-user-alt"></i>
                                <span class="uptitle">{{$user->getName() ?? ''}}</span>
                                <span class="downtitle">Tài khoản</span>
                                <ul>
                                    <li onclick="window.location.href='{{url()->route('myAccount')}}'"><i
                                            class="fas fa-tasks"></i> Quản lí tài khoản</li>
                                    <li style="background-color: #df4a32;"
                                        onclick="window.location.href='{{url()->route('logout')}}'"><i
                                            class="fas fa-sign-out-alt"></i> Đăng xuất</li>
                                </ul>
                            </li>

                        </div>
                        @else
                        <div class="rightoptions">
                            <li class="roption">
                                <i class="fas fa-user-alt"></i>
                                <span class="uptitle">Đăng nhập</span>
                                <span class="downtitle">Tài khoản</span>
                                <ul>
                                    <div class="sendform" id="login">
                                        <p class="logintitle">Đăng nhập</p>
                                        <form action="{{url()->route('login')}}" method="post">
                                            @csrf
                                            <div class="inputgroup">
                                                <input type="text" name="email" placeholder="Email đăng nhập"
                                                    autocomplete="off">
                                            </div>
                                            <div class="inputgroup">

                                                <input type="password" name="password" placeholder="Mật khẩu đăng nhập"
                                                    autocomplete="off">
                                            </div>
                                            <a id="clickforgot" class="forget" href="#forgot"><span>Quên mật khẩu
                                                    ?</span></a><br>
                                            <button class="sendnow" type="submit"><span>Đăng nhập ngay</span></button>
                                        </form>
                                    </div>
                                    <div class="sendform" id="register">

                                        <p class="logintitle">Đăng ký</p>
                                        <form action="{{url()->route('postRegister')}}" method="post">
                                            @csrf
                                            <div class="inputgroup">
                                                <input type="text" name="name" placeholder="Tên đầy đủ"
                                                    autocomplete="off">
                                            </div>
                                            <div class="inputgroup">
                                                <input type="text" name="phone" placeholder="Số điện thoại"
                                                    autocomplete="off">
                                            </div>
                                            <div class="inputgroup">

                                                <input type="text" name="email" placeholder="Email đăng nhập"
                                                    autocomplete="off">
                                            </div>
                                            <div class="inputgroup">

                                                <input type="password" name="password" placeholder="Mật khẩu đăng nhập"
                                                    autocomplete="off">
                                            </div>
                                            <button class="sendnow"><span>Đăng ký ngay</span></button>
                                        </form>
                                    </div>
                                    <div class="sendform" id="forgot" style="position: relative;">

                                        <p class="logintitle"> Khôi phục tài khoản</p>
                                        <span style="margin-top:10px;width:100px;display:none;font-size:0.8em;"
                                            id="RecoveryMessage"></span>
                                        <form onsubmit="return false;">
                                            <div class="inputgroup" id="recoveryGroup">
                                                <input id="recoveryEmail" type="text" name="email" placeholder="Email"
                                                    autocomplete="off"> <br>
                                            </div>
                                            <p id="recoveryError"
                                                style="color:red;display:none;margin-top:5px;font-size:0.8em;"></p>
                                            <button class="sendnow" id="backlogin"><span>Trở lại</span></button>
                                            <button class="sendnow" id="recbutton" onclick="recovery()"><span>Khôi
                                                    phục</span></button>
                                        </form>
                                    </div>
                                    <script>
                                        var globalEmail = '';
                                        function recovery() {
                                            pRecoveryMessage = document.querySelector('#RecoveryMessage')
                                            pError = document.querySelector('#recoveryError')
                                            recoveryEmail = document.querySelector('#recoveryEmail')
                                            recbutton = document.querySelector('#recbutton');
                                            globalEmail = recoveryEmail.value;
                                            let email = recoveryEmail.value
                                            axios.post('{{url()->route('recovery')}}', {
                                                email: email,
                                                _token: '{{ csrf_token() }}'
                                            }).then(data => {
                                                data = data.data
                                                if (data.success) {
                                                    pError.style.display = 'none'
                                                    pRecoveryMessage.style.display = 'inline-block'
                                                    pRecoveryMessage.innerHTML = data.message
                                                    recoveryEmail.setAttribute('placeholder', 'Nhập mã số');
                                                    recoveryEmail.value = ''
                                                    recbutton.innerHTML = '<span>Xác Minh</span>'
                                                    recbutton.setAttribute('onclick', 'sendRecoveryCode()');

                                                } else {
                                                    recbutton.innerHTML = '<span>Khôi phục</span>'
                                                    recbutton.setAttribute('onclick', 'recovery()');
                                                    pError.style.display = 'block'
                                                    pError.innerHTML = data.message
                                                    pRecoveryMessage.style.display = 'none'
                                                }
                                            })
                                        }
                                        function sendRecoveryCode() {
                                            pRecoveryMessage = document.querySelector('#RecoveryMessage')
                                            pError = document.querySelector('#recoveryError')
                                            recoveryEmail = document.querySelector('#recoveryEmail')
                                            recbutton = document.querySelector('#recbutton');
                                            formGroup = document.querySelector('#recoveryGroup')
                                            axios.post('{{url()->route('postReset')}}', {
                                                _token: '{{csrf_token()}}',
                                                code: recoveryEmail.value,
                                                email: globalEmail
                                            }).then(data => {
                                                data = data.data
                                                if (data.canRecovery) {
                                                    pError.style.display = 'none'
                                                    recbutton.setAttribute('onclick', 'sendRecoveryInfo()');
                                                    recbutton.innerHTML = '<span>Cập Nhật</span>'
                                                    recoveryEmail.setAttribute('placeholder', 'Nhập mật khẩu mới')
                                                    recoveryEmail.setAttribute('type', 'password')
                                                    recoveryEmail.value = ''
                                                    input = document.createElement('input');
                                                    input.setAttribute('id', 'confirmPassword')
                                                    input.setAttribute('type', 'password')
                                                    input.setAttribute('placeholder', 'Xác nhận mật khẩu')
                                                    formGroup.appendChild(input)
                                                } else {
                                                    pError.style.display = 'block'
                                                    pError.innerHTML = data.message
                                                }
                                            })


                                        }
                                        function sendRecoveryInfo() {
                                            pRecoveryMessage = document.querySelector('#RecoveryMessage')
                                            pError = document.querySelector('#recoveryError')
                                            recoveryPass1 = document.querySelector('#recoveryEmail')
                                            recoveryPass2 = document.querySelector('#confirmPassword')
                                            recbutton = document.querySelector('#recbutton');
                                            formGroup = document.querySelector('#recoveryGroup')
                                            if (recoveryPass1.value != recoveryPass2.value) {
                                                pError.style.display = 'block'
                                                pError.innerHTML = 'Vui lòng nhập đúng mật khẩu'
                                            } else {
                                                axios.post('{{url()->route('postRecovery')}}', {
                                                    _token: '{{csrf_token()}}',
                                                    email: globalEmail,
                                                    password: recoveryPass1.value
                                                }).then(data => {
                                                    data = data.data
                                                    if (data.success) {
                                                        document.querySelector('#forgot').innerHTML = '<center style="font-size:1.2em;color:green">Cập nhật mật khẩu thành công</center>'
                                                        setTimeout(() => {
                                                            $('#forgot').hide();
                                                            $('#register').fadeOut(0);
                                                            $('#login').fadeIn(500);
                                                            $('#clickregister').show();
                                                            $('#clicklogin').hide();
                                                            document.querySelector('#forgot').innerHTML = '<p class="logintitle" > Khôi phục tài khoản</p><span style="margin-top:10px;width:100px;display:none;" id="RecoveryMessage"></span><form onsubmit="return false;"><div class="inputgroup" id="recoveryGroup"><input id="recoveryEmail" type="text" name="email" placeholder="Email"autocomplete="off"> <br></div><p id="recoveryError" style="color:red;display:none;margin-top:5px"></p><button class="sendnow" id="backlogin"><span>Trở lại</span></button><button class="sendnow" id="recbutton" onclick="recovery()"><span>Khôi phục</span></button></form>'
                                                        }, 1500);
                                                    }
                                                })
                                            }
                                        }
                                    </script>
                                    <li id="clicklogin"><i class="fas fa-sign-in-alt"></i> Đăng nhập</li>
                                    <li id="clickregister"><i class="fas fa-user-plus"></i> Đăng ký</li>
                                    <li style="background: #4166b2">&emsp;<i class="fab fa-facebook-f"></i>&emsp;| Đăng
                                        nhập với
                                        facebook</li>
                                    <li style="background-color: #df4a32;"
                                        onclick="window.location.href = '{{url()->route('GoogleRedirect')}}'"><i
                                            class="fab fa-google-plus-g"></i> | Đăng nhập với
                                        Google</li>
                                </ul>
                            </li>

                        </div>
                        @endif
                        <div class="cartarea">
                            <li>
                                <i style="font-size: 1.8em" class="fas fa-shopping-cart"></i>
                                <span class="carttitle">Giỏ hàng </span><b
                                    id="cartCount">{{$myCart->getQuantityAll()}}</b>
                                <ul id="myCart">
                                    @if ($myCart->getTotal()>0)
                                    <span class="yourcart">Sản phẩm đã chọn:</span>
                                    <div id="cartProducts">
                                        @foreach ($myCart->getCart() as $myProduct)
                                        <li>
                                            <img src="{{url($myProduct['avatar'])}}" alt="" class="cartimg">
                                            <span class="cartname"><a href="#">{{$myProduct['name']}} </a></span>
                                            <span class="cartinfo">
                                                <span class="cartcost">{{number_format($myProduct['price'])}}
                                                    <sup>VND</sup></span> x
                                                <span class="quantity">{{$myProduct['quantity']}}</span>
                                            </span>
                                            <span class="closecart"
                                                onclick="delCart({{$myProduct['id']}});this.parentElement.parentElement.removeChild(this.parentElement)">×</span>
                                        </li>
                                        @endforeach
                                    </div>
                                    <li class="carttotal">
                                        <span> Tổng cộng: {{number_format($myCart->getTotal())}} <sup>VND</sup></span>
                                    </li>
                                    <div class="groupcartbtn">
                                        <button class="btnviewcart"><a href="{{url('/cart')}}">Xem giỏ hàng</a></button>
                                        <button class="btncartpay"><a href="{{url('/payment')}}">Thanh toán
                                                ngay</a></button>
                                    </div>
                                    @else
                                    <div id="cartProducts">
                                        <span class="yourcart">Chưa có sản phẩm nào trong giỏ hàng</span>
                                    </div>
                                    @endif




                                </ul>
                            </li>
                        </div>
                    </div>


                </div>
                <!-- endboxtopmain -->


            </div>
            <!-- endboxtop -->

        </div>

        <!-- endheader -->
        <!-- body -->
        <div class="body">

            <!-- bodycenter -->
            <div class="bodycenter">
                <div class="mobilecats">
                    <p>DANH MỤC SẢN PHẨM</p>
                    <div class="mcats">
                        <div class="boxcat">
                            <img src="assets/img/dodadung.png" alt="">
                            <a href="#viewcat">
                                <p>Đồ da dụng</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/hon.png" alt="">
                            <a href="#viewcat">
                                <p>Văn phòng phẩm</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/denwa.png" alt="">
                            <a href="#viewcat">
                                <p>Điện thoại</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/fuku.png" alt="">
                            <a href="#viewcat">
                                <p>Thời trang<br>Phụ kiện</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/kireinishi.png" alt="">
                            <a href="#viewcat">
                                <p>Sức khỏe<br>làm đẹp</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/oto.jpg" alt="">
                            <a href="#viewcat">
                                <p>Xe máy, Ô tô</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/headphone.png" alt="">
                            <a href="#viewcat">
                                <p>Phụ Kiện<br>Thiết Bị Số</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/microwave.jpg" alt="">
                            <a href="#viewcat">
                                <p>Điện Gia Dụng</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/fan.png" alt="">
                            <a href="#viewcat">
                                <p>Nhà Cửa<br> Đời Sống</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/food.jpg" alt="">
                            <a href="#viewcat">
                                <p>Hàng Tiêu Dùng<br>Thực Phẩm</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/camera.png" alt="">
                            <a href="#viewcat">
                                <p>Máy Ảnh<br>Quay Phim</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/toy.png" alt="">
                            <a href="#viewcat">
                                <p>Đồ chơi<br>Mẹ & Bé</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/tent.jpg" alt="">
                            <a href="#viewcat">
                                <p>Thể Thao - Dã Ngoại</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="assets/img/fridge.png" alt="">
                            <a href="#viewcat">
                                <p>Điện Tử - Điện Lạnh</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="centerbanner" id="mobliebanner">
                    <a href="#centerbanner"><img src="assets/img/topbanner.png"></a>
                </div>
                <!-- breadcrumb -->
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{url('/')}}"><i class="fas fa-home"></i><span> Trang chủ</span></a></li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li><a href="{{url('/search')}}"><i class="fas fa-store"></i><span> Cửa hàng</span></a></li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li class="active"><a href="#cart"><i class="fas fa-shopping-cart"></i> Giỏ hàng
                                <small>({{$myCart->getQuantityAll()}} Sản
                                    phẩm)</small></a></li>

                    </ul>
                </div>
                <!-- endbreadcrumb -->
                <div class="cartlist">
                    <div class="groupcarts">
                        <div class="listproducts">
                            @if ($myCart->getTotal()>0)
                            <table>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thao tác</th>
                                </tr>
                                <form id="meCart" action="{{url()->route('editCart')}}" onsubmit="return false"
                                    method="POST">
                                    @csrf

                                    @foreach ($myCart->getCart() as $myProduct)
                                    <tr data-id="{{$myProduct['id']}}">
                                        <td class="productcart">
                                            <img src="{{url($myProduct['avatar'])}}" alt="">
                                            <a
                                                href="{{url('/products/'.App\Product::where('id',$myProduct['id'])->first()->slug)}}">
                                                <p>{{$myProduct['name']}}</p>
                                            </a>
                                        </td>
                                        <td class="pricecart">{{number_format($myProduct['price'])}}<sup>VND</sup></td>
                                        <td>
                                            <div class="quantitycart"><button>-</button><input style="font-size:1em;"
                                                    name="quantity[{{$myProduct['id']}}]" type="text"
                                                    value="{{$myProduct['quantity']}}"><button>+</button>
                                            </div>
                                        </td>
                                        <td><a href="javascript:avoid(0)"
                                                onclick="delCart({{$myProduct['id']}});console.log(this.parentElement.parentElement.parentElement.removeChild(this.parentElement.parentElement))"><button
                                                    class="delproduct"><i class="fas fa-trash"></i></button></a></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" id="freeship">
                                            <img src="assets/img/shipped.png" alt="">
                                            <p>miễn phí vận chuyển cho đơn hàng từ ₫200.000 (giảm tối đa ₫40.000) </p>
                                        </td>
                                    </tr>
                            </table>
                            <div class="updatecart">
                                <button class="backtobuy"> <a style="color:#25586b" href="{{url('/search')}}"><i
                                            class="fas fa-arrow-left"></i> Tiếp tục mua
                                        hàng </a></button>
                                <a href="">
                                    <button class="updatecartbtn"
                                        onclick="document.querySelector('#meCart').submit()">Cập nhật</button>
                                </a>
                            </div>
                            </form>
                            <script>
                                function delCart(id) {
                                    axios.post('{{url()->route('deleteCart')}}/', { id: id }).then(data => {
                                        setTimeout(() => {
                                            if (data.data.success) {
                                                let count = 0;
                                                let stringLi = ''
                                                data.data.dataCart.map(product => {
                                                    count += product.quantity
                                                    stringLi += '<li><img src="../' + product.avatar + '" alt="" class="cartimg"><span class="cartname"><a href="#">' + product.name + ' </a></span><span class="cartinfo"><span class="cartcost">' + new Intl.NumberFormat('ja-JP').format(product.price) + ' <sup>VND</sup></span> x<span class="quantity">' + product.quantity + '</span></span><span class="closecart" onclick="delCart(' + product.id + ');this.parentElement.parentElement.removeChild(this.parentElement)">×</span></li>'
                                                })
                                                if (count == 0) {
                                                    window.location.reload()
                                                    return;
                                                } else {
                                                    document.querySelectorAll('table tr').forEach(e => {
                                                        if (e.dataset.id == id) {
                                                            console.log(document.querySelector('table'))
                                                            document.querySelector('table tbody').removeChild(e)
                                                        }
                                                    })
                                                    document.querySelector('#cartProducts').innerHTML = stringLi
                                                }
                                                document.querySelector('#myCart').setAttribute('style', 'display:block')
                                                setTimeout(() => {
                                                    document.querySelector('#myCart').removeAttribute('style')
                                                }, 5000);
                                                document.querySelector('#cartCount').innerHTML = count


                                            }
                                        }, 0);
                                    })
                                }
                            </script>
                        </div>
                        <div class="paynow">
                            <div class="ptitle">
                                Tổng tiền hàng
                            </div>
                            <div class="eachprice">
                                @foreach ($myCart->getCart() as $myProduct)
                                <li>{{$myProduct['name']}} x {{$myProduct['quantity']}}
                                    <span>{{number_format($myProduct['quantity'] * $myProduct['price'])}}<sup>đ</sup>
                                    </span>
                                </li>
                                @endforeach
                                <li>Thành tiền:<span>{{number_format($myCart->getTotal())}}<sup>đ</sup></span></li>
                                <li><a href="{{url('/payment')}}"><button class="paynowbtn">THANH TOÁN NGAY</button></a>
                                </li>
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
                @if($myCart->getTotal()<=0) <h3 style="padding:50px 0px;text-align:center">Chưa có sản phẩm nào trong
                    giỏ hàng của bạn.</h3>
                    @endif
                    <!-- flashsales -->
                    <div class="flashsales" id="foryou">
                        <div class="salestitle">
                            CÓ THỂ BẠN CŨNG THÍCH
                        </div>
                        <div class="salesproducts">
                            @foreach ($recommandProducts as $product)
                            <div class="product">
                                <div class="imgbox">
                                   <a href="#viewflash">
                                      <img src="{{isset($product->ImgAvt->src) ? url($product->ImgAvt->src) : ''}}" alt="">
                                   </a>
                                   <div class="groupcart">
                                      <a href="javascript:void(0)"> <button title="Thêm vào danh sách yêu thích"><i
                                               onclick="if(this.getAttribute('class')=='fas fa-heart'){delLove({{$product->id}});this.setAttribute('class','far fa-heart')}else{addLove({{$product->id}});this.setAttribute('class','fas fa-heart')}"
                                               class="@if($enjoy->is_exists($product->id))
                                               fas fa-heart
                                            @else
                                               far fa-heart
                                            @endif"></i></button></a>
                                      <a href="#cartoption" onclick="addCartX({{$product->id}})""> <button onclick="addCartX({{$product->id}})"
                                            title="Thêm vào giỏ hàng"><i class="fas fa-cart-plus"></i></button></a>
                                   </div>
                                   @if ($product->isNew())
                                   <span id="new_trend"><img src="../assets/img/new.png" alt=""></span>
                                   @endif
                                </div>
                                @php
                                $discount = $product->Discount->toArray();
                                @endphp
                                @if (count($discount)>0)
                                <div class="salespercent">{{$discount[0]['percent'] ?? ''}}% </div>
                                @endif
           
                                <div class="product_name"><a href="{{url('./products/'.$product->slug)}}">{{$product->name}}</a>
                                </div>
                                <div class="product_price">
                                   @if (count($discount)>0)
                                   <span
                                      class="newprice">{{number_format($product->price-$discount[0]['percent']/100*$product->price)}}
                                      <sup>đ</sup></span>
                                   <span class="oldprice">{{number_format($product->price)}} <sup>đ</sup></span>
                                   @else
                                   <span class="newprice">{{number_format($product->price)}} <sup>đ</sup></span>
                                   @endif
           
                                </div>
                                <div class="rating">
                                   <p>
                                      @for ($i = 1; $i <= $product->Review->avg('star'); $i++)
                                         <i class="fas fa-star" style="color:orange" id="star"></i>
                                         @endfor
                                         @for ($i = 1; $i <= 5-$product->Review->avg('star'); $i++)
                                            <i class="fas fa-star" id="star"></i>
                                            @endfor
                                            <span id="review_count">({{$product->Review->count()}})</span>
                                   </p>
                                   <span class="selled"><i class="fas fa-check-double"></i>
                                      {{$product->getTotalQuantitySelled()}}</span>
                                </div>
                                <div class="supaddress">
                                    {{str_replace("Thành phố",'',str_replace("Tỉnh",'',$product->RlSeller->City->name))}}
                                </div>
           
                             </div>
                        
                            @endforeach
                            <script>
                                function addCartX(id) {
                                   let preCount = {{ $myCart-> getQuantityAll()}}
                                   let quan = 1
                                   axios.post('{{url()->route('addCart')}}', {
                                      id: id,
                                      quantity: quan
                                   }).then(data => {
                                      if (data.data.success) {
                                            window.location.reload()    
                                      }
                                   })
                                }
                                function addLove(id){   
                                    axios.post('{{url()->route('addEnjoy')}}',{
                                       id:id,
                                       type:1
                                    }).then(data=>{
                                       data = data.data
                                       if(data.success){
                                          
                                       }
                                    })
                                 }
                                 function delLove(id){
                                    axios.post('{{url()->route('delEnjoy')}}',{
                                       id:id,
                                    }).then(data=>{
                                    })
                                 }
                                </script>
                        </div>
                        <div class="btnloadmore">
                            <button class="loadmore"><span><i class="fas fa-spinner loadingicon"></i></span><span
                                    id="loadmoretext">Tải thêm <i
                                        class="fas fa-chevron-circle-down"></i></span></button>
                        </div>
                    </div>
                    <!-- endflashsales -->
                    <!-- categoriesforyou -->

                    <!-- endsearchtrending -->

            </div>
            <!-- endbodycenter -->

        </div>
        <!-- endbody -->
        <!-- footer -->

        <div class="footer">
            <div class="fhead">
                <div class="information">
                    <ul><span class="infotitle"><i class="far fa-question-circle"></i> HỖ TRỢ KHÁCH HÀNG</span>
                        <li><a href="#viewoptionfooter">Thứ 2 đến CN: 9h - 18h (Hotline), 7h - 22h (chat trực tuyến)</a>
                        </li>
                        <li><a href="#viewoptionfooter">Hotline: <font color="red" style="font-weight:bold!important">
                                    1900-6035</font>
                                (1000đ/phút , 8-21h kể cả T7, CN)</a></li>
                        <li><a href="#viewoptionfooter">yêu cầu hỗ trợ</a></li>
                        <li><a href="#viewoptionfooter">Câu hỏi thường gặp</a></li>
                        <li><a href="#viewoptionfooter">chính sách đổi trả</a></li>
                        <li><a href="#viewoptionfooter">hướng dẫn mua hàng</a></li>
                    </ul>
                    <ul><span class="infotitle"><i class="fas fa-cart-arrow-down"></i>
                            <font color="red" style="font-weight:bold!important;background: linear-gradient(90deg,#ff512f,#dd2476);
                                                            -webkit-background-clip: text;
                                                            -webkit-text-fill-color: transparent;"> Rozy.</font> Việt
                            Nam
                        </span>
                        <li><a href="#viewoptionfooter">Giới thiệu</a></li>
                        <li><a href="#viewoptionfooter">Giấy phép kinh doanh</a></li>
                        <li><a href="#viewoptionfooter">Qui trình hoạt động</a></li>
                        <li><a href="#viewoptionfooter">Đội ngũ nhân viên</a></li>
                        <li><a href="#viewoptionfooter">tuyển dụng</a></li>
                        <li><a href="#viewoptionfooter">chính sách bảo mật</a></li>
                        <li><a href="#viewoptionfooter">Điều khoản sử dụng</a></li>
                        <li><a href="#viewoptionfooter">cam kết</a></li>
                    </ul>
                    <ul><span class="infotitle"><i class="fas fa-map-marked-alt"></i> Các chi nhánh</span>

                        <li>- văn phòng đại diện đà nẵng
                            <p><i class="fas fa-map-marker-alt"></i> địa chỉ : 123 nam kỳ khởi nghĩa đà nẵng</p>
                            <p><i class="fas fa-phone-square"></i> Phone : +84 766 730 945 </p>
                        </li>

                        <li>- văn phòng đại diện hà nội
                            <p><i class="fas fa-map-marker-alt"></i> địa chỉ : 123 nam kỳ khởi nghĩa đà nẵng</p>
                            <p><i class="fas fa-phone-square"></i> Phone : +84 766 730 945 </p>
                        </li>

                        <li>- văn phòng đại diện tp hồ chí minh
                            <p><i class="fas fa-map-marker-alt"></i> địa chỉ : 123 nam kỳ khởi nghĩa đà nẵng </p>
                            <p><i class="fas fa-phone-square"></i> Phone : +84 766 730 945 </p>
                        </li>


                    </ul>
                    <ul><span class="infotitle"><i class="fas fa-bell"></i> Đăng kí nhận thông báo mới</span> <br>
                        <form action="" method="get" id="mailreg">
                            <input type="email" name="" id="" placeholder="Địa chỉ Email của bạn">
                            <button type="submit">Đăng ký</button>
                        </form>
                        <div class="mapnamegroup">
                            <div class="mapouter">
                                <div class="gmap_canvas"><iframe width="300" height="180" id="gmap_canvas"
                                        src="https://maps.google.com/maps?q=Nam%20k%E1%BB%B3%20kh%E1%BB%9Fi%20ngh%C4%A9a%20&t=&z=11&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                                <style>
                                    .mapouter {
                                        position: relative;
                                        text-align: right;
                                        height: 180px;
                                        width: 100% !important;
                                    }

                                    .gmap_canvas {
                                        overflow: hidden;
                                        background: none !important;
                                        height: 180px;
                                        width: 100%;
                                    }
                                </style>
                            </div>
                            <div class="maininfo">
                                <div class="logo">
                                    <i class="fas fa-cart-arrow-down"></i>
                                    <span class="logoname"> Rozy.</span>
                                </div>
                                <div class="company">
                                    <p>Công ty TNHH Thương mại điện tử Rozy</p>
                                    <p>Trụ sở chính: 123 Nam kỳ khởi nghĩa, Đà Nẵng</p>
                                    <p>Số ĐKKD: FE23456987</p>
                                    <p>Email: support@rozyonline.vn</p>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="ffoot">
                <div class="sups">
                    <p class="suptitle">Các nhà cung cấp chính</p>
                    <div class="supplier">

                        <a href="#viewsupplier"><img src="assets/img/apple.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/toshiba.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/lips.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/adidas.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/fashion.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/hp.png" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/fpt.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/amzon.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/fashion_2.png" alt=""></a>
                    </div>
                </div>
                <div class="sups" id="finaltop">
                    <p class="suptitle">Đối tác vận chuyển</p>
                    <div class="supplier">

                        <a href="#viewsupplier"><img src="assets/img/fedex.png" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/ghtk.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/ghn.png" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/gh247.png" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/viettel.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="assets/img/grab.png" alt=""></a>

                    </div>
                    <button id="gotop"><i class="fas fa-arrow-up"></i></button>
                </div>
            </div>
        </div>
        <!-- endfooter -->
    </div>

    
    <script src="assets/js/slide.min.js"></script>
    <script src="assets/js/lazy.js"></script>
    <!-- <script src="assets/js/lazy.plugin.js"></script> -->
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/cart.js"></script>
    <script src="../../../assets/js/socket.io.js"></script>
    <script src="../../../assets/js/socket.init.js"></script>
    <script>
        var getMsgURI = '{{url()->route('getMsgBySeller')}}'
		@if($user)
			socketAuth({{$user->id}},1,'{{$user->password}}')
		@endif
	</script>
</body>

</html>