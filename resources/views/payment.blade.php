<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt hàng</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
    <link rel="stylesheet" href="../assets/css/payment.css">
    <link rel="stylesheet" href="../assets/css/slide.min.css">
    <link rel="stylesheet" href="../assets/css/slide.theme.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="../assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.theme.min.css">
    <script src="../assets/js/axios.js"></script>
</head>

<body>
    <div class="rozy">
    @if(isset($messages) && $user)
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
                        <div class="mobilelogo"><a href="{{url()->route('filter')}}"><i
                                    class="fas fa-arrow-left"></i></a>
                        </div>
                        <!-- boxsearch -->
                        <div class="boxsearch">
                            <form action="result.html">
                                <input autocomplete="off" name="keyword" placeholder="Nhập từ khóa sản phẩm..."
                                    type="search" class="searchinput"><button onclick=""
                                    class="searchnow micnow"><span><i
                                            class="fas fa-microphone"></i></span></button><input type="text"
                                    id="category_select" list="datalist" placeholder="Tất cả danh mục"
                                    value="Tất cả danh mục"><button class="searchnow"><span><i
                                            class="fas fa-search"></i><span id="search_none">Tìm
                                            kiếm</span></span></button>
                                <datalist name="category_select" id="datalist">
                                    <option value="Tất cả danh mục" selected="selected">
                                    <option value="Điện Thoại - Máy Tính Bảng">
                                    <option value="Điện Tử - Điện Lạnh">
                                    <option value="Phụ Kiện - Thiết Bị Số">
                                    <option value="Laptop - Thiết bị IT">
                                    <option value="Máy Ảnh - Quay Phim">
                                    <option value="Điện Gia Dụng ">
                                    <option value="Nhà Cửa Đời Sống">
                                    <option value="Hàng Tiêu Dùng - Thực Phẩm">
                                    <option value="Đồ chơi, Mẹ & Bé">
                                    <option value="Làm Đẹp - Sức Khỏe">
                                    <option value="Thời trang - Phụ kiện">
                                    <option value="Thể Thao - Dã Ngoại">
                                    <option value="Xe Máy, Ô tô, Xe Đạp">
                                    <option value="Sách, VPP & Quà Tặng">
                                </datalist>
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
                            <p>ĐẶT HÀNG</p>
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
                                        <span> Tổng cộng: <span
                                                id="totalCart">{{number_format($myCart->getTotal())}}</span>
                                            <sup>VND</sup></span>
                                    </li>
                                    <div class="groupcartbtn">
                                        <button class="btnviewcart"><a href="{{url('/cart')}}">Xem giỏ hàng</a></button>
                                        <button class="btncartpay"><a href="{{url('/payment')}}">Thanh toán
                                                ngay</a></button>
                                    </div>
                                    @else
                                    <span class="yourcart">Chưa có sản phẩm nào trong giỏ hàng</span>
                                    @endif
                                </ul>
                            </li>
                        </div>
                        <script>
                            function delCart(id) {
                                axios.post('{{url()->route('deleteCart')}}/', { id: id }).then(data => {
                                    setTimeout(() => {
                                        if (data.data.success) {
                                            let count = 0;
                                            let stringLi = ''
                                            let total = 0
                                            data.data.dataCart.map(product => {
                                                count += product.quantity
                                                total += product.quantity * product.price
                                                stringLi += '<li><img src="../' + product.avatar + '" alt="" class="cartimg"><span class="cartname"><a href="#">' + product.name + ' </a></span><span class="cartinfo"><span class="cartcost">' + new Intl.NumberFormat('ja-JP').format(product.price) + ' <sup>VND</sup></span> x<span class="quantity">' + product.quantity + '</span></span><span class="closecart" onclick="delCart(' + product.id + ');this.parentElement.parentElement.removeChild(this.parentElement)">×</span></li>'
                                            })
                                            total = new Intl.NumberFormat('ja-JP').format(total)
                                            if (count == 0) {
                                                window.location.reload()
                                                return;
                                            } else {
                                                document.querySelector('#cartProducts').innerHTML = stringLi
                                            }
                                            document.querySelector('#myCart').setAttribute('style', 'display:block')
                                            setTimeout(() => {
                                                document.querySelector('#myCart').removeAttribute('style')
                                            }, 5000);
                                            document.querySelector('#cartCount').innerHTML = count
                                            document.querySelector('#totalCart').innerHTML = total
                                        }
                                    }, 0);
                                })
                            }
                        </script>

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
                            <img src="../assets/img/dodadung.png" alt="">
                            <a href="#viewcat">
                                <p>Đồ da dụng</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/hon.png" alt="">
                            <a href="#viewcat">
                                <p>Văn phòng phẩm</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/denwa.png" alt="">
                            <a href="#viewcat">
                                <p>Điện thoại</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/fuku.png" alt="">
                            <a href="#viewcat">
                                <p>Thời trang<br>Phụ kiện</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/kireinishi.png" alt="">
                            <a href="#viewcat">
                                <p>Sức khỏe<br>làm đẹp</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/oto.jpg" alt="">
                            <a href="#viewcat">
                                <p>Xe máy, Ô tô</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/headphone.png" alt="">
                            <a href="#viewcat">
                                <p>Phụ Kiện<br>Thiết Bị Số</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/microwave.jpg" alt="">
                            <a href="#viewcat">
                                <p>Điện Gia Dụng</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/fan.png" alt="">
                            <a href="#viewcat">
                                <p>Nhà Cửa<br> Đời Sống</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/food.jpg" alt="">
                            <a href="#viewcat">
                                <p>Hàng Tiêu Dùng<br>Thực Phẩm</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/camera.png" alt="">
                            <a href="#viewcat">
                                <p>Máy Ảnh<br>Quay Phim</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/toy.png" alt="">
                            <a href="#viewcat">
                                <p>Đồ chơi<br>Mẹ & Bé</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/tent.jpg" alt="">
                            <a href="#viewcat">
                                <p>Thể Thao - Dã Ngoại</p>
                            </a>
                        </div>
                        <div class="boxcat">
                            <img src="../assets/img/fridge.png" alt="">
                            <a href="#viewcat">
                                <p>Điện Tử - Điện Lạnh</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="centerbanner" id="mobliebanner">
                    <a href="#centerbanner"><img src="../assets/img/topbanner.png"></a>
                </div>
                <!-- breadcrumb -->
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{url()->route('home')}}"><i class="fas fa-home"></i><span> Trang chủ</span></a>
                        </li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li><a href="{{url()->route('filter')}} "><i class="fas fa-store"></i><span> Cửa hàng</span></a>
                        </li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li class="active"><a href=""><i class="fas fa-money-check-alt"></i> Tiến trình đặt
                                hàng</a></li>

                    </ul>
                </div>
                <!-- endbreadcrumb -->
                <style id="styleforprocess"></style>
                <div class="payment">
                    <div class="process">
                        <ul>
                            <li><a href="javascript:void(0)">1
                                    <span>Đăng nhập</span>
                                </a>
                                <p></p>
                            </li>
                            <li><a href="javascript:void(0)">2
                                    <span>Thông tin đặt hàng</span>
                                </a>
                                <p></p>
                            </li>
                            <li><a href="javascript:void(0)">3
                                    <span>Thanh toán</span>
                                </a>
                                <p></p>
                            </li>
                            <li><a href="javascript:void(0)">4
                                    <span>Hoàn tất đơn hàng</span>
                                </a>
                                <p></p>
                            </li>

                        </ul>
                    </div>
                    <div class="step1">
                        <div class="log2buy">

                            <div class="loginform" style="display:none">
                                <div class="log">
                                    <p class="ltitle">
                                        <i class="fas fa-user-lock"></i> Đăng nhập để đặt hàng
                                    </p>
                                    <form class="logform" onsubmit="return false">
                                        <input autofocus type="text" name="" id="logEmail"
                                            placeholder="Email">
                                        <input type="password" name="" id="logPwd" placeholder="Mật khẩu"></input>
                                        <button type="submit" onclick="login()">Đăng Nhập</button>
                                    </form>
                                    <script>
                                        function login(){
                                            let email = document.querySelector('#logEmail');
                                            let pwd = document.querySelector('#logPwd');
                                            axios.post('{{url()->route('login')}}',{
                                                _token:"{{ csrf_token() }}",
                                                email:email.value,
                                                password:pwd.value,
                                                type:'PAYMENT'
                                            }).then(data=>{
                                                data =data.data
                                                if(data.success){
                                                    window.location.reload()
                                                }else{
                                                    email.style.borderBottom = '1px solid red'
                                                    pwd.style.borderBottom = '1px solid red'
                                                }
                                            })
                                        }
                                    </script>
                                    <div class="orsoc">
                                        <div class="ortdiv">
                                            <p></p>
                                            <p class="ortitle">
                                                OR
                                            </p>
                                            <p></p>
                                        </div>
                                        <div class="logwith" style="text-align:center">
                                            <p>Đăng nhập với tài khoản mạng xã hội</p>
                                            <a href="http://" target="_blank" rel="noopener noreferrer">
                                                <button class="facelog" style="background:#4166b2"><i
                                                        class="fab fa-facebook-f"></i></button></a>
                                            <a href="{{url()->route('GoogleRedirect')}}" rel="noopener noreferrer">
                                                <button class="glog" style="background:#db4437"><i
                                                        class="fab fa-google-plus-g"></i></button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="reg">
                                    <div class="invitereg">
                                        <div class="topreg">
                                            <p>Chưa có tài khoản?</p>
                                            <p>Đăng kí và bắt đầu mua sắm, đặt hàng tại Rozy</p>
                                        </div>
                                        <button class="botreg">Tạo tài khoản</button>
                                    </div>
                                </div>
                                <div class="log reghidden">
                                    <p class="ltitle">
                                        <i class="fas fa-user-lock"></i> Tạo Tài Khoản Mới
                                    </p>
                                    <form onsubmit="return false" class="logform">
                                        <input autofocus type="text" name="" id="reName" placeholder="Họ và tên">
                                        <input type="text" name="" id="reEmail" placeholder="Địa chỉ Email"></input>
                                        <input  type="text" name="" id="rePhone" placeholder="Số điện thoại">
                                        <input type="text" name="" id="reAddress" placeholder="Địa chỉ"></input>
                                        <input  type="text" name="" id="rePass" placeholder="Mật khẩu">
                                        <button type="submit" onclick="register()">Đăng Ký</button>
                                    </form>
                                    <script>
                                        function register(){
                                            let name = document.querySelector('#reName')
                                            let email = document.querySelector('#reEmail')
                                            let phone = document.querySelector('#rePhone')
                                            let address = document.querySelector('#reAddress')
                                            let pwd = document.querySelector('#rePass')
                                            axios.post('{{url()->route('postRegister')}}',{
                                                _token:"{{ csrf_token() }}",
                                                email:email.value,
                                                password:pwd.value,
                                                name:name.value,
                                                phone:phone.value,
                                                address:address.value,
                                                type:'PAYMENT'
                                            }).then(data=>{
                                                data =data.data
                                                if(data.success){
                                                    window.location.reload()
                                                }else{
                                                    name.style.borderBottom = '1px solid red'
                                                    phone.style.borderBottom = '1px solid red'
                                                    email.style.borderBottom = '1px solid red'
                                                    pwd.style.borderBottom = '1px solid red'
                                                    address.style.borderBottom = '1px solid red'
                                                }
                                            }).catch(errors=>{
                                                name.style.borderBottom = '1px solid red'
                                                phone.style.borderBottom = '1px solid red'
                                                email.style.borderBottom = '1px solid red'
                                                pwd.style.borderBottom = '1px solid red'
                                                address.style.borderBottom = '1px solid red'
                                            })
                                        }
                                    </script>
                                    <div class="orsoc">
                                        <div class="ortdiv">
                                            <p></p>
                                            <p class="ortitle">
                                                OR
                                            </p>
                                            <p></p>
                                        </div>
                                        <div class="logwith" style="text-align:center">
                                            <p>Đăng ký với tài khoản mạng xã hội</p>
                                            <a href="http://" target="_blank" rel="noopener noreferrer">
                                                <button class="facelog" style="background:#4166b2"><i
                                                        class="fab fa-facebook-f"></i></button></a>
                                            <a href="{{url()->route('GoogleRedirect')}}" rel="noopener noreferrer">
                                                <button class="glog" style="background:#db4437"><i
                                                        class="fab fa-google-plus-g"></i></button></a>
                            
                                        </div>
                                    </div>
                                </div>
                                <div class="reg loghidden">
                                    <div class="invitereg">
                                        <div class="topreg">
                                            <p>Đã có tài khoản?</p>
                                            <p>Đăng nhập ngayvà bắt đầu mua sắm, đặt hàng tại Rozy</p>
                                        </div>
                                        <button class="botreg">Đăng nhập</button>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout_info" style="display:none">
                                <div class="area1">
                                    <div class="pititle">
                                        <p><i class="fas fa-user-shield" style="color:#007ff0"></i> Thông tin người nhận
                                        </p>
                                    </div>
                                    <div class="formuser">
                                        <div>
                                            <input type="radio" name="pickuser" value="0" id="pickuser0" checked>
                                            @if ($user)
                                            <label for="pickuser0"><p>{{$user->getInfo()->gender==1 ? 'Anh' : 'Chị'}}<span class="namer"> {{$user->getInfo()->name}}</span> |
                                                <span class="phoner">{{$user->getInfo()->phone}}</span> <br>
                                                <span style="font-size:0.9em;">Thông tin mặc định trên tài khoản</span>
                                            </p></label>
                                            @endif
                                        </div>
                                        <div>
                                            <input type="radio" name="pickuser" value="1" id="pickuser1">
                                            <label for="pickuser1"><p>
                                                Thêm thông tin người nhận khác:
                                            </p></label>
                                        </div>
                                        <form class="infoform" onsubmit="return false">
                                            <table>
                                                <tr>
                                                    <td>HỌ TÊN NGƯỜI NHẬN</td>
                                                    <td><input onchange="document.querySelector('#pickuser1').checked=true" id="shipName" type="text" placeholder="Họ tên người nhận"></td>
                                                </tr>
                                                <tr>
                                                    <td>SỐ ĐIỆN THOẠI</td>
                                                    <td><input onchange="document.querySelector('#pickuser1').checked=true" id="shipPhone" type="text"
                                                            placeholder="Số điện thoại liên hệ khi giao hàng"></td>
                                                </tr>
                                            </table>
                                        </form>

                                    </div>
                                </div>
                                <div class="area1">
                                    <div class="pititle">
                                        <p><i class="fas fa-map-marker-alt" style="color:#007ff0"></i> Địa chỉ nhận hàng
                                        </p>
                                    </div>
                                    <div class="formuser">
                                        <div>
                                            <input onclick="UpdateTotal()" type="radio" name="pickaddress" value="0" id="pickaddress0" checked>
                                            @if ($user)
                                            <label for="pickaddress0"><p> Tại <span class="namer"> {{$user->getInfo()->address}} </span> |
                                                <span style="font-size:0.9em;">Địa chỉ mặc định trên tài khoản</span>
                                            </p></label>
                                            @endif
                                        </div>
                                        <div>
                                            <input type="radio" name="pickaddress" value="1" id="pickaddress1">
                                            <label for="pickaddress1"><p>
                                                Thêm địa chỉ nhận hàng khác:
                                            </p></label>
                                        </div>
                                        
                                        <form class="infoform">
                                            <table>
                                                <tr>
                                                    <td>TỈNH THÀNH</td>
                                                    <td><select onchange="getDistrict()" type="text" placeholder="Chọn Tỉnh Thành" id="shipCity">
                                                        <option value="0">Chọn tỉnh thành</option>
                                                        @foreach ($city->get() as $c)
                                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>QUẬN HUYỆN</td>
                                                    <td><select onchange="getCommune()" disabled=1 type="text" placeholder="Chọn Quận/Huyện" id="shipDistrict">
                                                            
                                                        </select></td>
                                
                                                </tr>
                                                <tr>
                                                    <td>PHƯỜNG / XÃ</td>
                                                    <td><select onchange="document.querySelector('#shipStreet').removeAttribute('disabled')" disabled=1 type="text" placeholder="Chọn Phường/Xã" id="shipCommune">
                                                        
                                                    </select>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>SỐ NHÀ - ĐƯỜNG</td>
                                                    <td><input id="shipStreet" disabled=1 type="text" placeholder="Nhập số nhà, tên đường"></td>
                                                </tr>
                                            </table>
                                        </form>
                                        <script>
                                            var shipMethod = '{{$shippers->get()->last()->id}}';
                                            var shippers = {!!$shippers->get()->toJson()!!}
                                            var city = document.querySelector('#shipCity')
                                            var district = document.querySelector('#shipDistrict')
                                            var commune = document.querySelector('#shipCommune')
                                            var street = document.querySelector('#shipStreet')
                                            function checkStep2(){
                                                check = true
                                                if(!document.querySelector('#pickaddress0').checked){
                                                    if(district.value==''){
                                                        check= false
                                                        district.style.border = '1px solid red'
                                                    }
                                                    if(city.value=='0'){
                                                        check= false
                                                        city.style.border = '1px solid red'
                                                    }
                                                    if(commune.value==''){
                                                        check= false
                                                        commune.style.border = '1px solid red'
                                                    }
                                                    if(street.value==''){
                                                        check= false
                                                        street.style.border = '1px solid red'
                                                    }
                                                }
                                                if(!document.querySelector('#pickuser0').checked){
                                                    if(document.querySelector('#shipName').value == ''){
                                                        check= false
                                                        document.querySelector('#shipName').style.border = '1px solid red'
                                                    }
                                                    if(document.querySelector('#shipPhone').value == ''){
                                                        check= false
                                                        document.querySelector('#shipPhone').style.border = '1px solid red'
                                                    }
                                                }
                                                if(check){
                                                    return gotostep(3)
                                                }else return false
                                            }
                                            function checkStep3(){
                                                check = true;
                                                let payMethod = null;
                                                pays = document.querySelectorAll('#paytype')
                                                pays.forEach(p=>{
                                                    if(p.checked) payMethod = parseInt(p.value)
                                                })
                                                if(payMethod!==1 && payMethod !==2 && payMethod!==3) check = false;
                                                console.log(check)
                                                if(payMethod==1){
                                                    console.log()
                                                    if(document.querySelector('#cardName').value==''){
                                                        document.querySelector('#cardName').style.border = '1px solid red'
                                                        check = false
                                                    }
                                                    if(isNaN(document.querySelector('#cardCode').value) || document.querySelector('#cardCode').value == ''){
                                                        check = false
                                                        document.querySelector('#cardCode').style.border = '1px solid red'
                                                    }
                                                    if(!document.querySelector('#cardDay').value.match(/(0[1-9]|1[0-2])\/([0-9][0-9])/g)) {
                                                        check = false
                                                        document.querySelector('#cardDay').style.border = '1px solid red'
                                                    }
                                                    if(isNaN(document.querySelector('#cardCvv').value) || document.querySelector('#cardCvv').value == ''){
                                                        check = false
                                                        document.querySelector('#cardCvv').style.border = '1px solid red'
                                                    }
                                                }
                                                if(check){
                                                    axios.post('{{url()->route('createOrders')}}',{
                                                        'name': document.querySelector('#pickuser0').checked ? '@if($user){{$user->getInfo()->name}}@endif': document.querySelector('#shipName').value,
                                                        'phone': document.querySelector('#pickuser0').checked ? '@if($user){{$user->getInfo()->phone}}@endif': document.querySelector('#shipPhone').value,
                                                        'city': document.querySelector('#pickaddress0').checked ? 0: parseInt(city.options[city.selectedIndex].value),
                                                        'district':document.querySelector('#pickaddress0').checked ? 0:parseInt(district.options[district.selectedIndex].value),
                                                        'commune':document.querySelector('#pickaddress0').checked ? 0:parseInt(commune.options[commune.selectedIndex].value),
                                                        'street':document.querySelector('#pickaddress0').checked ? 0:street.value,
                                                        'shipType':parseInt(shipMethod),
                                                        'payType':parseInt(payMethod)
                                                    }).then(d=>{
                                                        data = d.data
                                                        if(data.success){
                                                            gotostep(4)
                                                        }else{
                                                            if(data.field.indexOf('phone')>=0 || data.field.indexOf('name')>=0 
                                                            || data.field.indexOf('city')>=0 || data.field.indexOf('district')>=0
                                                            || data.field.indexOf('commune')>=0 || data.field.indexOf('street')>=0){
                                                                gotostep(2)
                                                                if(data.field.indexOf('name')>=0){
                                                                    document.querySelector('#shipName').style.border = '1px solid red'
                                                                }else document.querySelector('#shipName').style.border = '1px solid #acacac4f'
                                                                if(data.field.indexOf('phone')>=0){
                                                                    document.querySelector('#shipPhone').style.border = '1px solid red'
                                                                }else document.querySelector('#shipPhone').style.border = '1px solid #acacac4f'
                                                                if(data.field.indexOf('city')>=0){
                                                                    city.style.border = '1px solid red'
                                                                }else city.style.border = '1px solid #acacac4f'
                                                                if(data.field.indexOf('district')>=0){
                                                                    district.style.border = '1px solid red'
                                                                }else district.style.border = '1px solid #acacac4f'
                                                                if(data.field.indexOf('commune')>=0){
                                                                    commune.style.border = '1px solid red'
                                                                }else commune.style.border = '1px solid #acacac4f'
                                                                if(data.field.indexOf('street')>=0){
                                                                    street.style.border = '1px solid red'
                                                                }else street.style.border = '1px solid #acacac4f'
                                                            }

                                                        }
                                                    })
                                                    return gotostep(4)
                                                }
                                                else return false;
                                            }   

                                            function getDistrict(){
                                                document.querySelector('#pickaddress1').checked=true
                                                pickCity = city.options[city.selectedIndex].value
                                                if(pickCity==0){
                                                    district.setAttribute('disabled','1')
                                                    commune.setAttribute('disabled','1')
                                                    commune.innerHTML = ''
                                                    street.setAttribute('disabled','1')
                                                    street.value =''
                                                }
                                                axios.post('{{url()->route('address')}}',{
                                                    _token: '{{ csrf_token() }}',
                                                    city:pickCity
                                                }).then(data=>{
                                                    data = data.data
                                                    html = ''
                                                    data.forEach(dist=>{
                                                        html+='<option value="'+dist.id+'">'+dist.name+'</option>'
                                                    })
                                                    district.innerHTML = html
                                                    district.removeAttribute('disabled')
                                                    
                                                })
                                            }
                                            function getCommune(){
                                                pickDistrict = district.options[district.selectedIndex].value
                                                axios.post('{{url()->route('address')}}',{
                                                    _token: '{{ csrf_token() }}',
                                                    district:pickDistrict
                                                }).then(data=>{
                                                    data = data.data
                                                    html = ''
                                                    data.forEach(comm=>{
                                                        html+='<option value="'+comm.id+'">'+comm.name+'</option>'
                                                    })
                                                    commune.innerHTML = html
                                                    commune.removeAttribute('disabled')
                                                    street.removeAttribute('disabled')
                                                    
                                                })
                                                calShip()
                                            }
                                            function calShip(){
                                                shippers.forEach(shipper=>{
                                                    document.querySelector('#shipCost_'+shipper.id).innerHTML = '--đang tính--'
                                                    document.querySelector('#shipDay_'+shipper.id).innerHTML ='--đang tính--'
                                                    axios.post('{{url()->route('getShipPrice')}}',{
                                                        district:district.value,
                                                        city:city.value,
                                                        shipper:shipper.id
                                                    }).then(d=>{
                                                        data = d.data
                                                        avgDay = Math.ceil(data.reduce((sum,value)=>sum+value.inDay,0)/data.length)
                                                        document.querySelector('#shipDay_'+shipper.id).innerHTML = avgDay+' - '+(avgDay+1)+' ngày'
                                                        document.querySelector('#shipCost_'+shipper.id).innerHTML =new Intl.NumberFormat('ja-JP').format(data.reduce((sum,value)=>sum+value.price,0))
                                                        document.querySelectorAll('#checkShipper').forEach(shipRadio=>{
                                                        if(shipRadio.checked){
                                                            document.querySelector('#shipTotal').innerHTML = new Intl.NumberFormat('ja-JP').format(data.reduce((sum,value)=>sum+value.price,0))+'<sup>đ</sup>'
                                                            document.querySelector('#shipTotal').dataset.price = data.reduce((sum,value)=>sum+value.price,0) 
                                                            if(document.querySelector('#cpTotal')) document.querySelector('#superTotal').innerHTML =  new Intl.NumberFormat('ja-JP').format(parseInt(document.querySelector('#shipTotal').dataset.price)+parseInt(document.querySelector('#productPrice').dataset.price) + parseInt(document.querySelector('#cpTotal').dataset.price))+'<sup>đ</sup>'
                                                            else document.querySelector('#superTotal').innerHTML =  new Intl.NumberFormat('ja-JP').format(parseInt(document.querySelector('#shipTotal').dataset.price)+parseInt(document.querySelector('#productPrice').dataset.price))+'<sup>đ</sup>'
                                                            
                                                        }
                                                    })
                                                })
                                            })
                                        }
                                            function UpdateTotal(){
                                                if(document.querySelector('#pickaddress0').checked==true){
                                                    shippers.forEach(shipper=>{
                                                        document.querySelector('#shipCost_'+shipper.id).innerHTML = '--đang tính--'
                                                        document.querySelector('#shipDay_'+shipper.id).innerHTML ='--đang tính--'
                                                        axios.post('{{url()->route('getShipPrice')}}',{
                                                            district:district.value,
                                                            city:city.value,
                                                            shipper:shipper.id,
                                                            pureAddress: '{{$user ? $user->getInfo()->address:''}}'
                                                        }).then(d=>{
                                                            data = d.data
                                                            avgDay = Math.ceil(data.reduce((sum,value)=>sum+value.inDay,0)/data.length)
                                                            document.querySelector('#shipDay_'+shipper.id).innerHTML = avgDay+' - '+(avgDay+1)+' ngày'
                                                            document.querySelector('#shipCost_'+shipper.id).innerHTML = new Intl.NumberFormat('ja-JP').format(data.reduce((sum,value)=>sum+value.price,0))
                                                            document.querySelectorAll('#checkShipper').forEach(shipRadio=>{
                                                            if(shipRadio.checked){
                                                                document.querySelector('#shipTotal').innerHTML = new Intl.NumberFormat('ja-JP').format(data.reduce((sum,value)=>sum+value.price,0))+'<sup>đ</sup>'
                                                                document.querySelector('#shipTotal').dataset.price = data.reduce((sum,value)=>sum+value.price,0)  
                                                                if(document.querySelector('#cpTotal')) document.querySelector('#superTotal').innerHTML =  new Intl.NumberFormat('ja-JP').format(parseInt(document.querySelector('#shipTotal').dataset.price)+parseInt(document.querySelector('#productPrice').dataset.price) + parseInt(document.querySelector('#cpTotal').dataset.price))+'<sup>đ</sup>'
                                                                else document.querySelector('#superTotal').innerHTML =  new Intl.NumberFormat('ja-JP').format(parseInt(document.querySelector('#shipTotal').dataset.price)+parseInt(document.querySelector('#productPrice').dataset.price))+'<sup>đ</sup>'
                                                            
                                                            }
                                                        })
                                                        })
                                                    })
                                                }
                                            }
                                            window.onload = ()=>{
                                                UpdateTotal()
                                            }
                                        </script>
                                    </div>
                                </div>
                                <div class="area1">
                                    <div class="pititle">
                                        <p><i class="fas fa-shipping-fast" style="color:#007ff0"></i> Phương thức vận
                                            chuyển</p>
                                    </div>
                                    <div class="formuser">
                                        @foreach ($shippers->get() as $shipper)
                                        <div class="shipper_{{$shipper->id}}" data-id="{{$shipper->id}}">
                                            <input type="radio" onclick="shipMethod=this.value;if(document.querySelector('#shipCost_'+this.value).innerHTML.indexOf('tính')<0) document.querySelector('#shipTotal').innerHTML = new Intl.NumberFormat('ja-JP').format(this.parentElement.childNodes[3].childNodes[3].childNodes[7].childNodes[0].innerHTML.replace(',',''))+'<sup>đ</sup>';
                                                document.querySelector('#shipTotal').dataset.price = this.parentElement.childNodes[3].childNodes[3].childNodes[7].childNodes[0].innerHTML.replace(',','');
                                                if(document.querySelector('#cpTotal')) document.querySelector('#superTotal').innerHTML =  new Intl.NumberFormat('ja-JP').format(parseInt(document.querySelector('#shipTotal').dataset.price)+parseInt(document.querySelector('#productPrice').dataset.price) + parseInt(document.querySelector('#cpTotal').dataset.price))+'<sup>đ</sup>'; else document.querySelector('#superTotal').innerHTML =  new Intl.NumberFormat('ja-JP').format(parseInt(document.querySelector('#shipTotal').dataset.price)+parseInt(document.querySelector('#productPrice').dataset.price))+'<sup>đ</sup>'"
                                             name="pickmethod" id="checkShipper" value="{{$shipper->id}}" @if($shipper == $shippers->get()->last()) checked @endif style="height:54px">
                                            <p style="display:flex">
                                                <img style="height: 40px;width:40px;margin-right: 10px"
                                                    src="{{url($shipper->logo)}}" alt="">
                                            <span><b style="color:#007ff0">{{$shipper->name}}</b> <br>
                                                    Thời gian dự kiến: <b id="shipDay_{{$shipper->id}}">--chưa tính--</b><br>
                                            Phí vận chuyển: <b style="color:red"><span id="shipCost_{{$shipper->id}}">--chưa tính--</span> <sup>đ</sup></b>
                                                </span>
                                            </p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="paymethod" style="display:none">
                                <div class="choose">
                                    <div class="active" >
                                        <p>
                                            <img src="../assets/img/visa_logo.png" alt="">
                                            <img src="../assets/img/mastercard_logo.png" alt="">
                                        </p>
                                        <input type="radio" name="paytype" id="paytype" value="1" checked><span> Thanh toán bằng thẻ tín
                                            dụng</span>
                                    </div>
                                    <div>
                                        <p>
                                            <img src="../assets/img/bankicon.png" alt="">
                                        </p>
                                        <input type="radio" name="paytype" id="paytype" value="2"><span> Thanh toán qua chuyển khoản</span>
                                    </div>
                                    <div>
                                        <p>
                                            <img src="../assets/img/paywhenre.png" alt="">
                                        </p>
                                        <input type="radio" name="paytype" id="paytype" value="3"><span> Thanh toán khi nhận hàng</span>
                                    </div>
                                </div>
                                <div class="formccv">
                                    <form action="" onsubmit="return false;">
                                        <div class="form1_2">
                                            <label for="code">Tên chủ thẻ</label><br>
                                            <input id="cardName" autofocus type="text" name=""
                                                style="background:url('assets/img/people.svg') 95% no-repeat;background-size: 15px 15px">
                                        </div>
                                        <div class="form1_2">
                                            <label for="code">Mã thẻ</label><br>
                                            <input id="cardCode" type="text" name=""
                                                style="background:url('assets/img/ccv.png') 95% no-repeat;background-size: 15px 15px">
                                        </div>
                                        <div class="form1_4">
                                            <label for="code">Ngày hết hạn</label><br>
                                            <input id="cardDay" placeholder="MM/YY" type="text" name=""
                                                style="background:url('assets/img/lich.png') 95% no-repeat;background-size: 15px 15px">
                                        </div>
                                        <div class="form1_4">
                                            <label for="code">CCV/CVV</label><br>
                                            <input id="cardCvv" placeholder="" type="text" name=""
                                                style="background:url('assets/img/khoa.png') 95% no-repeat;background-size: 15px 15px">
                                        </div>
                                        <div class="form1_2">   
                                            <p class="noteccv">*CVV hoặc CVC là mã bảo mật thẻ, số có ba chữ số duy nhất
                                                ở mặt sau thẻ của bạn tách biệt với số của nó.</p>
                                        </div>
                                    </form>
                                </div>
                                <div class="formbank" style="display:none">
                                    <p class="banktitle">
                                        Thanh toán qua chuyển khoản
                                    </p>
                                    <div class="banktext">

                                        <p><strong>Thông tin thanh toán:</strong>&nbsp;</p>
                                        <p><span style="font-family: Arial, sans-serif; font-size: 10pt;">Thanh toán
                                                bằng hình thức chuyển khoản ATM hoặc ủy nhiệm chi.&nbsp;</span><span
                                                style="font-family: Arial, sans-serif; font-size: 10pt;">Quý khách có
                                                thể chuyển khoản vào các tài khoản sau, bằng cách ra ngân hàng gần nhất
                                                chuyển khoản theo phương thức ủy nhiệm chi hoặc qua thẻ ATM, Internet
                                                Banking, cổng thanh toán điện tử, ...</span></p>
                                        <p><span
                                                style="font-family: Arial, sans-serif; font-size: 10pt;">&nbsp;</span><strong
                                                style="font-family: Arial, sans-serif; font-size: 10pt;"><span
                                                    style="font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">Ngân
                                                    Hàng ACB&nbsp;</span></strong><span
                                                style="font-family: Arial, sans-serif; font-size: 10pt;">- CN Hồ Chí
                                                Minh</span></p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">Số
                                                tài khoản: 138826059</span></p>
                                        <p class="MsoNormal" style="mso-margin-top-alt: auto; margin-bottom: 12.0pt;">
                                            <span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">Người
                                                thụ hưởng: Giang Thanh Hải</span></p>
                                        <p class="MsoNormal" style="mso-margin-top-alt: auto; margin-bottom: 12.0pt;">
                                            &nbsp;</p>
                                        <p class="MsoNormal" style="mso-margin-top-alt: auto; margin-bottom: 12.0pt;">
                                            <strong><span
                                                    style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">Ngân
                                                    Hàng HSBC</span></strong><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">&nbsp;-
                                                CN Metropolitan</span></p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">Địa
                                                chỉ: 235 Đồng Khởi, Quận 1, Hồ Chí Minh.</span></p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">Số
                                                tài khoản:&nbsp; 091 066167 041&nbsp;</span></p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">Người
                                                thụ hưởng: Giang Thanh Hải </span><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">&nbsp;</span>
                                        </p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">&nbsp;</span>
                                        </p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><strong><span
                                                    style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">Ngân
                                                    Hàng Vietcombank</span></strong><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">&nbsp;-
                                                CN Hồ Chí Minh</span></p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><span
                                                style="font-family: Arial, sans-serif; font-size: 10pt;">Số tài
                                                khoản:&nbsp; 0071001122087</span></p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">Người
                                                thụ hưởng: Giang Thanh Hải&nbsp;</span></p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;">&nbsp;</p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;">
                                            <strong>BAOKIM.VN -&nbsp;</strong>CỔNG THANH TOÁN ĐIỆN TỬ BẢO KIM</p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;">Email nhận
                                            thanh toán: vucms@rozyonline.vn</p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;">&nbsp;</p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">&nbsp;</span><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">*
                                                <strong>Lưu ý quan trọng:&nbsp;</strong> Hãy thêm Mã Biên Lai trong phần
                                                "Ghi chú giao dịch" (Note to recipient). </span></p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;">*Mã biên lai
                                            nằm ngay dưới phần Tóm Tắt Đơn Hàng, bắt đầu bằng HVN... hoặc bạn có thể tìm
                                            thấy nó tại mục Thanh Toán trong cpanel.rozyonline.vn&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p><strong><span style="color: #000000;">Xác nhận thanh toán:</span></strong>
                                        </p>
                                        <p>Sau khi thanh toán thành công, để chúng tôi có thể xử lý đơn hàng của bạn
                                            nhanh chóng, phiền bạn cung cấp chứng từ thanh toán hoặc ủy nhiệm chi, tên
                                            ngân hàng bạn gửi tới, tới địa chỉ email:&nbsp;<span
                                                style="color: #0000ff;"><strong>vucms@rozyonline.vn</strong></span>&nbsp;(tốt
                                            nhất sử dụng email thành viên Hostinger để gửi) theo mẫu sau:</p>
                                        <p><strong>Tiêu đề (Subject)</strong>: Payment Confirmation<br><strong>Nội dung
                                                (Content):&nbsp;</strong></p>
                                        <p>Ngân hàng thụ hưởng (Receiving Bank):&nbsp;</p>
                                        <p>Mã biên lai (Receipt)*:&nbsp;</p>
                                        <p>Tên người gửi (Sender name):&nbsp;</p>
                                        <p>Đính kèm chứng từ giao dịch, ủy nhiệm chi nếu có.</p>
                                        <p><em>Khi nhận được thông tin chuyển tiền và nhận được email của quý khách,
                                                chúng tôi sẽ tiến hành thực hiện yêu cầu của bạn trong vòng <strong>24
                                                    giờ</strong> trong ngày làm việc.</em></p>
                                        <p class="MsoNormal"
                                            style="mso-margin-top-alt: auto; mso-margin-bottom-alt: auto;"><span
                                                style="font-size: 10.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;;">&nbsp;</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="formdirect" style="padding:0px ;display: none">
                                    <p class="banktitle">
                                        Thanh toán khi nhận hàng
                                    </p>
                                    <div style="display:flex">
                                        <img src="../assets/img/tien-mat.jpg" alt="" style="height:100px;">
                                        <p style="padding-left: 15px;font-size: 1.1em;">
                                            <b>Lưu ý khi thanh toán theo phương pháp này:</b><br>
                                            Quý khách có thể thanh toán tiền mặt trực tiếp khi mua hàng tại
                                            Hệ thống siêu thị ROZY, hoặc thanh toán cho nhân viên chuyển phát đối với
                                            hình thức chuyển phát COD khi mua hàng trực tuyến qua <a
                                                href="#">website</a>.
                                            young across seed might degree live <a href="#">nearest</a> studying post
                                            substance sugar settle key <br> definition trace rising personal gulf cold
                                            sang community bit bee detail
                                            usuual lay mass connected prove feet sharp begun hill mother earlier trick
                                            circle press young across seed might degree live <a href="#">nearest</a>
                                            studying post substance sugar settle key definition trace rising personal
                                            gulf cold sang community bit bee detail
                                            usuual lay mass connected prove feet sharp begun hill mother earlier
                                            trick<br> circle pres young across seed might degree live <a
                                                href="#">nearest</a> studying post substance sugar settle key definition
                                            trace rising personal gulf cold sang community bit bee detail
                                            usuual lay mass connected prove feet sharp begun hill mother earlier trick
                                            circle pres burst thou breakfast helpful perfect course fort me husband bell
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="payfinish" style="display:none">
                                <p class="successimg">
                                    <img src="../assets/img/checked.png" alt="">
                                </p>
                                <div class="centertext">
                                    <span>Đơn hàng của bạn đã được chúng tôi ghi nhận, hãy thực hiện theo các hướng dẫn.
                                        Chúng tôi sẽ liên hệ với bạn sớm theo thông tin bạn đã cung cấp.
                                        <br><i>Chúc bạn một ngày tốt lành !</i>
                                    </span>
                                    <p style="text-align: center"><a href="{{url()->route('myOrders')}}"><button>Quản lí đơn hàng   </button></a></p>
                                </div>
                            </div>
                            <div class="stepredirect">
                                <button id="back">Trở về</button>
                                <button id="next" @if (request()->step==2) onclick="checkStep2()" @endif>Bước tiếp</button>
                            </div>
                        </div>
                        <div class="yourcartlist">
                            <p class="ycltitle">
                                <i class="fas fa-vote-yea" style="color:rgb(55, 179, 55)"></i> Thông tin đơn hàng
                            </p>
                            <div class="listitems">
                                <ul>
                                    @foreach ($myCart->getCart() as $myProduct)
                                    <li>
                                        <img src="{{url($myProduct['avatar'])}}" alt="">
                                        <p class="itemcart">
                                            <span>{{$myProduct['name']}}</span><br>
                                            <span>{{number_format($myProduct['price'])}}<sup>VND</sup></span>
                                        </p>
                                        <span class="itemquan">x{{$myProduct['quantity']}}</span>
                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                            <div class="noteship">
                                <p>Lưu ý:Chương trình miễn phí vận chuyển không áp dụng cho trường hợp đặt hộ.
                                    Để hưởng ưu đãi miễn phí vận chuyển, bạn vui lòng dùng số điện thoại trong tài khoản
                                    để đặt và nhận hàng.
                                    Chi tiết chương trình <a href="#"> tại đây</a>.</p>
                            </div>
                            <div class="paynow">
                                <div class="ptitle">
                                    Đặt hàng
                                </div>
                                <div class="eachprice">
                                    <li>Tổng tiền hàng: <span id="productPrice" data-price="{{$myCart->getTotal()}}">{{number_format($myCart->getTotal())}} <sup>đ</sup></span>
                                    </li>
                                    <li>Phí vận chuyển:<span id="shipTotal" data-price="">@if (request()->step < 3) --chưa tính-- @else @endif <sup>
                                                đ</sup></span></li>
                                    @if (Session::get('coupons') && count(Session::get('coupons')[0])>0 && intval(request()->step)<3)
                                    @php
                                       $t = 0;
                                       foreach(Session::get('coupons') as $cp) $t += $cp['value'];
                                    @endphp
                                    <li>Mã giảm giá:<span id="cpTotal" data-price="-{{$t}}">-{{number_format($t)}}<sup>đ</sup></span></li>
                                    @endif
                                    <li>Thành tiền:<span id="superTotal">@if (request()->step < 3) --chưa tính-- @else @endif <sup>đ</sup></span></li>
                                </div>
                                <div class="coupon">
                                    <p class="cptitle"><i class="fas fa-tags"></i> Mã khuyến mãi</p>
                                    <form method="post" action="{{url()->route('checkCoupon')}}" style="display:block;width:100%">
                                        <div class="coupongroup">
                                            @csrf
                                            <input name="coupon" type="text"><button>Áp dụng</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
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

                        <a href="#viewsupplier"><img src="../assets/img/apple.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/toshiba.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/lips.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/adidas.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/fashion.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/hp.png" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/fpt.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/amzon.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/fashion_2.png" alt=""></a>
                    </div>
                </div>
                <div class="sups" id="finaltop">
                    <p class="suptitle">Đối tác vận chuyển</p>
                    <div class="supplier">

                        <a href="#viewsupplier"><img src="../assets/img/fedex.png" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/ghtk.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/ghn.png" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/gh247.png" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/viettel.jpg" alt=""></a>
                        <a href="#viewsupplier"><img src="../assets/img/grab.png" alt=""></a>

                    </div>
                    <button id="gotop"><i class="fas fa-arrow-up"></i></button>
                </div>
            </div>
        </div>
        <!-- endfooter -->
    </div>
    <script>
    var isLogin = @if($user) true @else false @endif;
    </script>
    <script src="../assets/js/slide.min.js"></script>
    <script src="../assets/js/lazy.js"></script>
    <!-- <script src="../assets/js/lazy.plugin.js"></script> -->
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets/js/payment.js"></script>
    <script src="../../../assets/js/socket.io.js"></script>
    <script src="../../../assets/js/socket.init.js"></script>
    <script>
        var getMsgURI = '{{url()->route('getMsgBySeller')}}'
		@if($user)
			socketAuth({{$user->id}},1,'{{$user->password}}')
		@endif
	</script>
    <script>
    gotostep({{intval(request()->step)==0 ? 1:intval(request()->step)}})
    </script>
</body>
</html>

