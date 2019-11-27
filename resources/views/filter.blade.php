<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{'Tìm kiếm cho "'.@$filter['keyword'].'"'}}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/filter.css">
    <link rel="stylesheet" href="assets/css/slide.min.css">
    <link rel="stylesheet" href="assets/css/slide.theme.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.theme.min.css">
    <script src="../assets/js/axios.js"></script>
    <script src="assets/js/jquery.min.js"></script>
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
                <span style="margin-left:18%"><i class="fas fa-map-marker-alt"></i> 123 Nam Ky
                    Khoi Nghia, Da Nang</span>
                <span style="margin-left:300px"><i class="fas fa-phone"></i> +84 766 730 945 |
                    Support: 0236 456 789 | Sales: 0236 456 710</span>
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
                                <input value="{{$filter['keyword'] ?? ''}}" autocomplete="off" name="keyword"
                                    placeholder="Nhập từ khóa sản phẩm..." type="search" class="searchinput">
                                <button onclick="" class="searchnow micnow"><span><i
                                            class="fas fa-microphone"></i></span>
                                </button>
                                <select name="cat" type="text" id="category_select">
                                    <option value="0">Tất cả danh mục</option>
                                    @foreach ($categories as $category)
                                    @if ($category->id==@$filter['cat'])
                                    <option selected=selected value="{{$category->id}}">{{$category->name}}</option>
                                    @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
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
                                    <li><a href="result.html"><img src="assets/img/denwa.png"><span>SamSung Galaxy
                                                A30</span></a></li>
                                    <li><a href="result.html"><img src="assets/img/product1.png"><span>iPhone
                                                X</span></a></li>
                                    <li><a href="result.html"><img src="assets/img/product.jpg"><span>Móc
                                                Khóa</span></a></li>
                                    <li><a href="result.html"><img
                                                src="assets/img/product2.jpg"><span>SmartPhone</span></a></li>
                                    <li><a href="result.html"><img src="assets/img/product4.jpg"><span>Chuột Máy
                                                Tính</span></a></li>
                                    <li><a href="result.html"><img src="assets/img/product5.jpg"><span>Đồng
                                                Hồ</span></a></li>
                                    <li><a href="result.html"><img src="assets/img/mega14.jpg"><span>Sách Hay</span></a>
                                    </li>
                                    <li><a href="result.html"><img src="assets/img/denwa.png"><span>Điện
                                                Thoại</span></a></li>
                                    <li><a href="result.html"><img src="assets/img/bike.png"><span>Xe máy
                                                Sirius</span></a></li>
                                </ul>
                                <p class="ideatitle">
                                    Từ Khóa Hot:
                                </p>
                                <ul id="hotkeyidea">
                                    <li><a href="result.html">bone </a></li>
                                    <li><a href="result.html">then </a></li>
                                    <li><a href="result.html">why </a></li>
                                    <li><a href="result.html">prevent </a></li>
                                    <li><a href="result.html">adventure </a></li>
                                    <li><a href="result.html">blank </a></li>
                                    <li><a href="result.html">enjoy </a></li>

                                </ul>
                            </div>
                            <p>THỜI TRANG NAM</p>
                        </div>
                        <div class="mobliecart"><i class="fas fa-shopping-cart"></i>
                            <ul>
                                <span class="yourcart">Sản phẩm bạn đã chọn (4) :</span>
                                <li>
                                    <img src="assets/img/product1.png" alt="" class="cartimg">
                                    <span class="cartname"><a href="#">Galaxy S6 32Gb 3Gb Ram abc xyz </a></span>
                                    <span class="cartinfo">
                                        <span class="cartcost">10,000,000 <sup>VND</sup></span> x
                                        <span class="quantity">1</span>
                                    </span>
                                    <span class="closecart">×</span>
                                </li>
                                <li>
                                    <img src="assets/img/mega6.jpg" alt="" class="cartimg">
                                    <span class="cartname"><a href="#">Iphone X 64 GB Ram 4Gb</a></span>
                                    <span class="cartinfo">
                                        <span class="cartcost">20,000,000 <sup>VND</sup></span> x
                                        <span class="quantity">1</span>
                                    </span>
                                    <span class="closecart">×</span>
                                </li>

                                <li>
                                    <img src="assets/img/product1.png" alt="" class="cartimg">
                                    <span class="cartname"><a href="#">Galaxy S6 32Gb 3Gb Ram abc xyz </a></span>
                                    <span class="cartinfo">
                                        <span class="cartcost">10,000,000 <sup>VND</sup></span> x
                                        <span class="quantity">1</span>
                                    </span>
                                    <span class="closecart">×</span>
                                </li>
                                <li>
                                    <img src="assets/img/mega6.jpg" alt="" class="cartimg">
                                    <span class="cartname"><a href="#">Iphone X 64 GB Ram 4Gb</a></span>
                                    <span class="cartinfo">
                                        <span class="cartcost">20,000,000 <sup>VND</sup></span> x
                                        <span class="quantity">1</span>
                                    </span>
                                    <span class="closecart">×</span>
                                </li>
                                <li class="carttotal">
                                    <span> Tổng cộng: 30,000,000 <sup>VND</sup></span>
                                </li>

                                <div class="groupcartbtn">
                                    <button class="btnviewcart"><a href="{{url('/cart')}}">Xem giỏ hàng</a></button>
                                    <button class="btncartpay"><a href="{{url('/payment')}}">Thanh toán
                                            ngay</a></button>
                                </div>
                            </ul>
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
                                      <form action="{{url()->route('login')}}" method="post" >
                                            @csrf
                                            <div class="inputgroup">
                                               <input type="text" name="email" placeholder="Email đăng nhập" autocomplete="off">
                                            </div>
                                            <div class="inputgroup">
           
                                               <input type="password" name="password" placeholder="Mật khẩu đăng nhập" autocomplete="off">
                                            </div>
                                            <a id="clickforgot" class="forget" href="#forgot"><span>Quên mật khẩu ?</span></a><br>
                                            <button class="sendnow" type="submit"><span>Đăng nhập ngay</span></button>
                                         </form>
                                      </div>
                                      <div class="sendform" id="register">
                                         
                                         <p class="logintitle">Đăng ký</p>
                                      <form action="{{url()->route('postRegister')}}" method="post">
                                            @csrf
                                            <div class="inputgroup">
                                               <input type="text" name="name" placeholder="Tên đầy đủ" autocomplete="off">
                                            </div>
                                            <div class="inputgroup">
                                               <input type="text" name="phone" placeholder="Số điện thoại" autocomplete="off">
                                            </div>
                                            <div class="inputgroup">
           
                                               <input type="text" name="email" placeholder="Email đăng nhập" autocomplete="off">
                                            </div>
                                            <div class="inputgroup">
           
                                               <input type="password" name="password" placeholder="Mật khẩu đăng nhập"
                                                  autocomplete="off">
                                            </div>
                                            <button class="sendnow"><span>Đăng ký ngay</span></button>
                                         </form>
                                      </div>
                                      <div class="sendform" id="forgot" style="position: relative;">
           
                                         <p class="logintitle" > Khôi phục tài khoản</p>
                                         <span style="margin-top:10px;width:100px;display:none;font-size:0.8em;" id="RecoveryMessage"></span>
                                         <form onsubmit="return false;">
                                            <div class="inputgroup" id="recoveryGroup">
                                               <input id="recoveryEmail" type="text" name="email" placeholder="Email"
                                                  autocomplete="off"> <br>
                                            </div>
                                            <p id="recoveryError" style="color:red;display:none;margin-top:5px;font-size:0.8em;"></p>
                                            <button class="sendnow" id="backlogin"><span>Trở lại</span></button>
                                            <button class="sendnow" id="recbutton" onclick="recovery()"><span>Khôi phục</span></button>
                                         </form>
                                      </div>
                                      <script>
                                         var globalEmail = '';
                                            function recovery(){
                                               pRecoveryMessage = document.querySelector('#RecoveryMessage')
                                               pError = document.querySelector('#recoveryError')
                                               recoveryEmail = document.querySelector('#recoveryEmail')
                                               recbutton = document.querySelector('#recbutton');
                                               globalEmail = recoveryEmail.value;
                                               let email = recoveryEmail.value
                                               axios.post('{{url()->route('recovery')}}',{
                                                  email:email,
                                                  _token: '{{ csrf_token() }}'
                                               }).then(data=>{
                                                  data = data.data
                                                  if(data.success){
                                                     pError.style.display = 'none'
                                                     pRecoveryMessage.style.display = 'inline-block'
                                                     pRecoveryMessage.innerHTML = data.message
                                                     recoveryEmail.setAttribute('placeholder','Nhập mã số');
                                                     recoveryEmail.value = ''
                                                     recbutton.innerHTML = '<span>Xác Minh</span>'
                                                     recbutton.setAttribute('onclick','sendRecoveryCode()');
           
                                                  }else{
                                                     recbutton.innerHTML = '<span>Khôi phục</span>'
                                                     recbutton.setAttribute('onclick','recovery()');
                                                     pError.style.display = 'block'
                                                     pError.innerHTML = data.message
                                                     pRecoveryMessage.style.display = 'none'
                                                  }
                                               })
                                            }
                                            function sendRecoveryCode(){
                                               pRecoveryMessage = document.querySelector('#RecoveryMessage')
                                               pError = document.querySelector('#recoveryError')
                                               recoveryEmail = document.querySelector('#recoveryEmail')
                                               recbutton = document.querySelector('#recbutton');
                                               formGroup = document.querySelector('#recoveryGroup')
                                               axios.post('{{url()->route('postReset')}}',{
                                                  _token:'{{csrf_token()}}',
                                                  code:recoveryEmail.value,
                                                  email:globalEmail
                                               }).then(data=>{
                                                  data = data.data
                                                  if(data.canRecovery){
                                                     pError.style.display = 'none'
                                                     recbutton.setAttribute('onclick','sendRecoveryInfo()');
                                                     recbutton.innerHTML = '<span>Cập Nhật</span>'
                                                     recoveryEmail.setAttribute('placeholder','Nhập mật khẩu mới')
                                                     recoveryEmail.setAttribute('type','password')
                                                     recoveryEmail.value = ''
                                                     input = document.createElement('input');
                                                     input.setAttribute('id','confirmPassword')
                                                     input.setAttribute('type','password')
                                                     input.setAttribute('placeholder','Xác nhận mật khẩu')
                                                     formGroup.appendChild(input)
                                                  }else{
                                                     pError.style.display = 'block'
                                                     pError.innerHTML = data.message
                                                  }
                                               })
                                               
                                               
                                            }
                                            function sendRecoveryInfo(){
                                               pRecoveryMessage = document.querySelector('#RecoveryMessage')
                                               pError = document.querySelector('#recoveryError')
                                               recoveryPass1 = document.querySelector('#recoveryEmail')
                                               recoveryPass2 = document.querySelector('#confirmPassword')
                                               recbutton = document.querySelector('#recbutton');
                                               formGroup = document.querySelector('#recoveryGroup')
                                               if(recoveryPass1.value!= recoveryPass2.value){
                                                  pError.style.display = 'block'
                                                  pError.innerHTML = 'Vui lòng nhập đúng mật khẩu'
                                               }else{
                                                  axios.post('{{url()->route('postRecovery')}}',{
                                                     _token:'{{csrf_token()}}',
                                                     email:globalEmail,
                                                     password:recoveryPass1.value
                                                  }).then(data=>{
                                                     data = data.data
                                                     if(data.success){
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
                                      <li style="background: #4166b2">&emsp;<i class="fab fa-facebook-f"></i>&emsp;| Đăng nhập với
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
            <div class="bottomtool">
                <span><i class="fas fa-filter"></i> <a class="tabhiden" href="javascript:void(0)">Bộ Lọc</a> <i
                        class="fas fa-angle-double-right" id="mobliehiden"></i>
                    <div class="leftpoll">
                        <div class="allfilter">
                            <div class="categories" id="filtertool">
                                <p><i class="fas fa-filter"></i></i> BỘ LỌC</p>
                                <p class="parentcat"><i class="fas fa-caret-right"></i>
                                    Địa điểm bán</p>
                                @php
                                    $filterWithOutAddress = $filter;
                                    unset($filterWithOutAddress['address']);
                                @endphp
                               @foreach ($addresses as $addr)
                                <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['address'=>$addr->id]))}}"><input @if (request()->address==$addr->id)
                                    checked=true
                                @endif onchange="if(this.checked) window.location.href = '{{request()->fullUrlWithQuery(array_merge($filter,['address'=>$addr->id]))}}'; else window.location.href ='{{route('filter',$filterWithOutAddress)}}'" type="checkbox"></a>
                                {{$addr->name}}
                                </li>
                               @endforeach
                                <ul class="hidecats">
                                   a
                                </ul>
                                <li class="viewmorecat" onclick="console.log(document.querySelector('.hidecats'))">Xem thêm <i class="fas fa-sort-down"></i></li>
                            </div>
    
                            <div class="categories" id="costtool">
                                <p class="parentcat"><i class="fas fa-caret-right"></i>
                                    Khoảng giá</p>
                                <div class="groupprice">
                                    <form action="{{request()->fullUrlWithQuery($filter)}}">
                                        <input name=from type="number" class="lowprice" value="{{$filter['from'] ?? ''}}">
                                        <i class="fas fa-chevron-right breadarrow"></i>
                                        <input name=to type="number" class="highprice" value="{{$filter['to'] ?? ''}}">
                                        <button class="submitPrice">Submit</button>
                                    </form>
    
                                </div>
                                @php
                                $clonefilter = $filter;
                                $clonefilter['from'] = 0;
                                $clonefilter['to'] = 95000;
                                @endphp
                                <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                    {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> DƯỚI
                                        95K</li>
                                @php
                                $clonefilter['from'] = 95000;
                                $clonefilter['to'] = 200000;
                                @endphp
                                <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                    {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> 95K ~
                                        200K</a>
                                </li>
                                @php
                                $clonefilter['from'] = 200000;
                                $clonefilter['to'] = 500000;
                                @endphp
    
                                <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                    {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> 200K
                                        ~ 500K</a>
                                </li>
                                @php
                                $clonefilter['from'] = 500000;
                                $clonefilter['to'] = 1000000;
                                @endphp
                                <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                    {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> 500K
                                        ~ 1000K</a>
                                </li>
                                @php
                                $clonefilter['from'] = 1000000;
                                $clonefilter['to'] = 3000000;
                                @endphp
                                <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                    {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> 1000K
                                        ~ 3000K</a>
                                </li>
                            </div>
                            <div class="categories" id="shiptool">
                                <p class="parentcat"><i class="fas fa-caret-right"></i>
                                    Đánh giá</p>
                                <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>5]))}}">
                                    <p @if (request()->star==5)
                                        class=active
                                    @endif>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                    </p>
                                    </a>
                                </li>
                                <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>4]))}}">
                                    <p @if (request()->star==4)
                                        class=active
                                    @endif>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" id="star"></i>
                                    </p>
                                    </a>
                                </li>
                                <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>3]))}}">
                                    <p @if (request()->star==3)
                                        class=active
                                    @endif>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" id="star"></i>
                                        <i class="fas fa-star" id="star"></i>
                                    </p>
                                    </a>
                                </li>
                                <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>2]))}}">
                                    <p @if (request()->star==2)
                                        class=active
                                    @endif>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star" id="star"></i>
                                        <i class="fas fa-star" id="star"></i>
                                        <i class="fas fa-star" id="star"></i>
                                    </p>
                                    </a>
                                </li>
                                <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>1]))}}">
                                    <p @if (request()->star==1)
                                        class=active
                                    @endif>
                                        <i class="fas fa-star" style="color:orange" id="star"></i>
                                        <i class="fas fa-star"  id="star"></i>
                                        <i class="fas fa-star" id="star"></i>
                                        <i class="fas fa-star" id="star"></i>
                                        <i class="fas fa-star" id="star"></i>
                                    </p>
                                    </a>
                                </li>
                            </div>
    
    
                        </div>
                    </div>
                </span>
                <span><i class="fas fa-sort-amount-up"></i> Sắp xếp
                    <div class="sortpanel">
                        <form action="" method="get">
                            <ul> 
                                <li @if (request()->ordProp=='PRICE' && request()->ordType=='DESC')
                                    class=active
                                @endif><a href="{{route('filter',array_merge(['ordProp'=>'PRICE','ordType'=>'DESC'],$filter))}}"><i class="fas fa-sort-numeric-up"></i> Giá cao</a></li>
                                <li @if (request()->ordProp=='PRICE' && request()->ordType=='ASC')
                                    class=active
                                @endif><a href="{{route('filter',array_merge(['ordProp'=>'PRICE','ordType'=>'ASC'],$filter))}}"><i class="fas fa-sort-numeric-down"></i> Giá thấp</a></li>
                                <li @if (request()->ordProp=='NAME' && request()->ordType=='ASC')
                                    class=active
                                @endif><a href="{{route('filter',array_merge(['ordProp'=>'NAME','ordType'=>'ASC'],$filter))}}"><i class="fas fa-sort-alpha-down"></i> Từ A-Z</a></li>
                                <li @if (request()->ordProp=='NAME' && request()->ordType=='DESC')
                                    class=active
                                @endif><a href="{{route('filter',array_merge(['ordProp'=>'NAME','ordType'=>'DESC'],$filter))}}"><i class="fas fa-sort-alpha-up"></i> Từ Z-A</a></li>
                                <li @if (request()->ordProp=='VIEW')
                                    class=active
                                @endif><a href="{{route('filter',array_merge(['ordProp'=>'VIEW','ordType'=>'DESC'],$filter))}}"><i class="fas fa-eye"></i> Lượt xem</a></li>
                            </ul>
                        </form>
                    </div>
                </span>
            </div>
            <!-- bodycenter -->
            <div class="bodycenter">

                <!-- breadcrumb -->
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{url('/')}}"><i class="fas fa-home"></i><span> Trang
                                    chủ</span></a></li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li><a href="#"><i class="fas fa-filter"></i><span> Bộ Lọc</span></a></li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li>
                            <a href="{{url('/search?cat='.($filter['cat'] ?? '0'))}}">
                                <i
                                    class="{{@$filter['cat']==0 ? 'fas fa-globe' : App\Category::where("id",$filter['cat'])->first()->icon}}"></i>
                                <span>
                                    {{@$filter['cat']==0 ? 'Tất cả danh mục':App\Category::where("id",$filter['cat'])->first()->name}}</span>
                            </a>
                        </li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li class="active"><a href="#cart">
                                {{isset($filter['keyword']) ? '"'.$filter['keyword'].'"' : ''}}
                                <small>({{$countAfterFilter}} Sản
                                    phẩm)</small></a></li>

                    </ul>
                </div>
                <!-- endbreadcrumb -->
                <div class="slidertop">
                    <div class="hotdeal">
                        <div class="hotdealtitle">

                            <span>HOT <a href="javascript:void(0)">DEAL</a></span>
                        </div>
                        <div class="timereaming">
                            <span>
                                    
                                <li><a id="daydeal" href="javascript:void(0)">1</a> <sub>NGÀY</sub></li>
                                <li><a id="hourdeal" href="javascript:void(0)">3</a> <sub>Giờ</sub></li>
                                <li><a id="minutedeal" href="javascript:void(0)">50</a> <sub>Phút</sub></li>
                                <li><a id="seconddeal" href="javascript:void(0)">50</a> <sub>Giây</sub></li>

                            </span>
                        </div>
                    </div>
                    <div class="bannerslider">
                        <div class="movegroup">
                            <button class="customPrevBtn"><i class="fas fa-arrow-left"></i></button>
                            <button class="customNextBtn"><i class="fas fa-arrow-right"></i></button>
                        </div>
                        <div class="owl-carousel owl-theme bigslider">
                            <div class="item">
                                <a href="#viewbanner"><img src="assets/img/bigbanner1.png" alt=""></a>

                            </div>
                            <div class="item">
                                <a href="#viewbanner"><img src="assets/img/bigbanner2.jpg" alt=""></a>
                            </div>
                            <div class="item">
                                <a href="#viewbanner"><img src="assets/img/bigbanner3.jpg" alt=""></a>
                            </div>
                            <div class="item">
                                <a href="#viewbanner"><img src="assets/img/bigbanner4.png" alt=""></a>
                            </div>
                            <div class="item">
                                <a href="#viewbanner"><img src="assets/img/bigbanner5.png" alt=""></a>
                            </div>


                        </div>
                    </div>
                    <!-- endbannerslider -->
                    <div class="subbanner">
                        <div class="rbanner1">
                            <a href="#viewsmallbanner"><img src="assets/img/rsmallbanner1.jpg" alt=""></a>
                            <p class="lbar"></p>
                            <p class="rbar"></p>
                        </div>
                        <div class="rbanner2">
                            <a href="#viewsmallbanner"><img src="assets/img/rsmallbanner2.jpg" alt=""></a>
                            <p class="lbar"></p>
                            <p class="rbar"></p>
                        </div>
                    </div>
                </div>
                <div class="filter">
                    <div class="optioncol">
                        <div class="categories" id="filtertool">
                            <p><i class="fas fa-filter"></i></i> BỘ LỌC</p>
                            <p class="parentcat"><i class="fas fa-caret-right"></i>
                                Địa điểm bán</p>
                            @php
                                $filterWithOutAddress = $filter;
                                unset($filterWithOutAddress['address']);
                            @endphp
                            @if ($addresses->count()>5)
                                @for ($i = 0; $i < 5; $i++)
                                @php
                                    $addr = $addresses->slice($i,1)->first();
                                @endphp
                                <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['address'=>$addr->id]))}}"><input 
                                    @if (request()->address==$addr->id)
                                    checked=true
                                    @endif onchange="if(this.checked) window.location.href = '{{request()->fullUrlWithQuery(array_merge($filter,['address'=>$addr->id]))}}'; else window.location.href ='{{route('filter',$filterWithOutAddress)}}'" type="checkbox">{{$addr->name}}</a>
                                @endfor
                                <ul class="hidecats" id="hdcat">
                                        @for ($i = 5; $i < count($addresses); $i++)
                                @php
                                    $addr = $addresses[$i];
                                @endphp
                                <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['address'=>$addr->id]))}}"><input 
                                    @if (request()->address==$addr->id)
                                    checked=true
                                    @endif onchange="if(this.checked) window.location.href = '{{request()->fullUrlWithQuery(array_merge($filter,['address'=>$addr->id]))}}'; else window.location.href ='{{route('filter',$filterWithOutAddress)}}'" type="checkbox">{{$addr->name}}</a>
                                @endfor
                                </ul>
                                <li class="viewmorecat" onclick="document.querySelector('#hdcat').style.display = 'block';this.style.display= 'none'">Xem thêm <i class="fas fa-sort-down"></i></li>
                            @else
                            @foreach ($addresses as $addr)
                                <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['address'=>$addr->id]))}}"><input 
                                    @if (request()->address==$addr->id)
                                    checked=true
                                @endif onchange="if(this.checked) window.location.href = '{{request()->fullUrlWithQuery(array_merge($filter,['address'=>$addr->id]))}}'; else window.location.href ='{{route('filter',$filterWithOutAddress)}}'" type="checkbox"></a>
                                
                                {{$addr->name}}
                                </li>
                           @endforeach
                           @endif
                        </div>

                        <div class="categories" id="costtool">
                            <p class="parentcat"><i class="fas fa-caret-right"></i>
                                Khoảng giá</p>
                            <div class="groupprice">
                                <form action="{{request()->fullUrlWithQuery($filter)}}">
                                    <input name=from type="number" class="lowprice" value="{{$filter['from'] ?? ''}}">
                                    <i class="fas fa-chevron-right breadarrow"></i>
                                    <input name=to type="number" class="highprice" value="{{$filter['to'] ?? ''}}">
                                    <button class="submitPrice">Submit</button>
                                </form>

                            </div>
                            @php
                            $clonefilter = $filter;
                            $clonefilter['from'] = 0;
                            $clonefilter['to'] = 95000;
                            @endphp
                            <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> DƯỚI
                                    95K</li>
                            @php
                            $clonefilter['from'] = 95000;
                            $clonefilter['to'] = 200000;
                            @endphp
                            <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> 95K ~
                                    200K</a>
                            </li>
                            @php
                            $clonefilter['from'] = 200000;
                            $clonefilter['to'] = 500000;
                            @endphp

                            <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> 200K
                                    ~ 500K</a>
                            </li>
                            @php
                            $clonefilter['from'] = 500000;
                            $clonefilter['to'] = 1000000;
                            @endphp
                            <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> 500K
                                    ~ 1000K</a>
                            </li>
                            @php
                            $clonefilter['from'] = 1000000;
                            $clonefilter['to'] = 3000000;
                            @endphp
                            <li @if ($clonefilter['from']==@$filter['from'] && $clonefilter['to']==@$filter['to'])
                                {{'class=active'}} @endif><a href="{{request()->fullUrlWithQuery($clonefilter)}}"> 1000K
                                    ~ 3000K</a>
                            </li>
                        </div>
                        <div class="categories" id="shiptool">
                            <p class="parentcat"><i class="fas fa-caret-right"></i>
                                Đánh giá</p>
                            <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>5]))}}">
                                <p @if (request()->star==5)
                                    class=active
                                @endif>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                </p>
                                </a>
                            </li>
                            <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>4]))}}">
                                <p @if (request()->star==4)
                                    class=active
                                @endif>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" id="star"></i>
                                </p>
                                </a>
                            </li>
                            <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>3]))}}">
                                <p @if (request()->star==3)
                                    class=active
                                @endif>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" id="star"></i>
                                    <i class="fas fa-star" id="star"></i>
                                </p>
                                </a>
                            </li>
                            <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>2]))}}">
                                <p @if (request()->star==2)
                                    class=active
                                @endif>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star" id="star"></i>
                                    <i class="fas fa-star" id="star"></i>
                                    <i class="fas fa-star" id="star"></i>
                                </p>
                                </a>
                            </li>
                            <li><a href="{{request()->fullUrlWithQuery(array_merge($filter,['star'=>1]))}}">
                                <p @if (request()->star==1)
                                    class=active
                                @endif>
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    <i class="fas fa-star"  id="star"></i>
                                    <i class="fas fa-star" id="star"></i>
                                    <i class="fas fa-star" id="star"></i>
                                    <i class="fas fa-star" id="star"></i>
                                </p>
                                </a>
                            </li>
                        </div>


                    </div>
                    <!-- flashsales -->
                    <div class="flashsales" id="foryou">

                        <div class="stitle">
                            <span><i class="fas fa-sort"></i> Sắp xếp theo</span>
                            <div class="groupsort">
                                <a href="{{route('filter',['keyword'=>@$filter['keyword'],'idcat'=>@$filter['keyword']])}}"><button data-sort="popular" 
                                    @if (request()->ordProp=='ALL' || request()->ordProp===null)
                                    class=active
                                @endif><i class="fas fa-industry"></i> Tất cả </button></a>
                                <a href="{{route('filter',array_merge(['ordProp'=>'HOTSELL','ordType'=>'DESC'],$filter))}}"><button data-sort="sales" 
                                    @if (request()->ordProp=='HOTSELL')
                                    class=active
                                @endif><i class="fab fa-hotjar"></i> Bán chạy</button></a>
                                <a href="{{route('filter',array_merge(['ordProp'=>'CREATE','ordType'=>'DESC'],$filter))}}"><button data-sort="date" 
                                    @if (request()->ordProp=='CREATE')
                                    class=active
                                @endif><i class="fas fa-history" ></i> Ngày ra mắt</button></a>
                                <a href="{{route('filter',array_merge(['ordProp'=>'RATE','ordType'=>'DESC'],$filter))}}"><button data-sort="vote" 
                                    @if (request()->ordProp=='RATE')
                                    class=active
                                @endif><i class="fas fa-vote-yea"></i> Đánh giá</button></a>
                            </div>
                            <div class="groupsortby @if (request()->ordProp=='PRICE' || request()->ordProp=='NAME' || request()->ordProp=='VIEW' )
                                active
                            @endif" >
                                <button class="sortby">Sắp xếp theo <i class="fas fa-chevron-down"></i>
                                    <ul> 
                                        <li @if (request()->ordProp=='PRICE' && request()->ordType=='DESC')
                                            class=active
                                        @endif><a href="{{route('filter',array_merge(['ordProp'=>'PRICE','ordType'=>'DESC'],$filter))}}"><i class="fas fa-sort-numeric-up"></i> Giá cao</a></li>
                                        <li @if (request()->ordProp=='PRICE' && request()->ordType=='ASC')
                                            class=active
                                        @endif><a href="{{route('filter',array_merge(['ordProp'=>'PRICE','ordType'=>'ASC'],$filter))}}"><i class="fas fa-sort-numeric-down"></i> Giá thấp</a></li>
                                        <li @if (request()->ordProp=='NAME' && request()->ordType=='ASC')
                                            class=active
                                        @endif><a href="{{route('filter',array_merge(['ordProp'=>'NAME','ordType'=>'ASC'],$filter))}}"><i class="fas fa-sort-alpha-down"></i> Từ A-Z</a></li>
                                        <li @if (request()->ordProp=='NAME' && request()->ordType=='DESC')
                                            class=active
                                        @endif><a href="{{route('filter',array_merge(['ordProp'=>'NAME','ordType'=>'DESC'],$filter))}}"><i class="fas fa-sort-alpha-up"></i> Từ Z-A</a></li>
                                        <li @if (request()->ordProp=='VIEW')
                                            class=active
                                        @endif><a href="{{route('filter',array_merge(['ordProp'=>'VIEW','ordType'=>'DESC'],$filter))}}"><i class="fas fa-eye"></i> Lượt xem</a></li>
                                    </ul>
                                </button>
                            </div>
                        </div>
                        <div class="salesproducts">
                            @foreach ($products as $product)
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
                                    <div class="salespercent">{{$discount[0]->percent ?? ''}}% </div>
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
                                       {{$product->getAddress()}}
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
                        <div class="btnloadmore" id="pagination">
                            {{$products->links()}}
                        </div>
                    </div>
                    <!-- endflashsales -->
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
                    <ul><span class="infotitle"><i class="far fa-question-circle"></i> HỖ
                            TRỢ KHÁCH HÀNG</span>
                        <li><a href="#viewoptionfooter">Thứ 2 đến CN: 9h - 18h
                                (Hotline), 7h - 22h (chat trực
                                tuyến)</a></li>
                        <li><a href="#viewoptionfooter">Hotline: <font color="red" style="font-weight:bold!important">
                                    1900-6035</font>
                                (1000đ/phút , 8-21h kể cả T7, CN)</a>
                        </li>
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
                        <li><a href="#viewoptionfooter">Giấy phép kinh doanh</a>
                        </li>
                        <li><a href="#viewoptionfooter">Qui trình hoạt động</a></li>
                        <li><a href="#viewoptionfooter">Đội ngũ nhân viên</a></li>
                        <li><a href="#viewoptionfooter">tuyển dụng</a></li>
                        <li><a href="#viewoptionfooter">chính sách bảo mật</a></li>
                        <li><a href="#viewoptionfooter">Điều khoản sử dụng</a></li>
                        <li><a href="#viewoptionfooter">cam kết</a></li>
                    </ul>
                    <ul><span class="infotitle"><i class="fas fa-map-marked-alt"></i> Các
                            chi nhánh</span>

                        <li>- văn phòng đại diện đà nẵng
                            <p><i class="fas fa-map-marker-alt"></i> địa chỉ :
                                123 nam kỳ khởi nghĩa đà nẵng</p>
                            <p><i class="fas fa-phone-square"></i> Phone : +84
                                766 730 945 </p>
                        </li>

                        <li>- văn phòng đại diện hà nội
                            <p><i class="fas fa-map-marker-alt"></i> địa chỉ :
                                123 nam kỳ khởi nghĩa đà nẵng</p>
                            <p><i class="fas fa-phone-square"></i> Phone : +84
                                766 730 945 </p>
                        </li>

                        <li>- văn phòng đại diện tp hồ chí minh
                            <p><i class="fas fa-map-marker-alt"></i> địa chỉ :
                                123 nam kỳ khởi nghĩa đà nẵng </p>
                            <p><i class="fas fa-phone-square"></i> Phone : +84
                                766 730 945 </p>
                        </li>


                    </ul>
                    <ul><span class="infotitle"><i class="fas fa-bell"></i> Đăng kí nhận
                            thông báo mới</span> <br>
                        <form action="" method="get" id="mailreg">
                            <input type="email" name="" id="" placeholder="Địa chỉ Email của bạn">
                            <button type="submit">Đăng ký</button>
                        </form>
                        <div class="mapnamegroup">
                            <div class="mapouter">
                                <div class="gmap_canvas"><iframe width="300" height="180" id="gmap_canvas"
                                        src="https://maps.google.com/maps?q=Nam%20k%E1%BB%B3%20kh%E1%BB%9Fi%20ngh%C4%A9a%20&t=&z=11&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div>
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
                                    <span class="logoname">
                                        Rozy.</span>
                                </div>
                                <div class="company">
                                    <p>Công ty TNHH Thương mại
                                        điện tử Rozy</p>
                                    <p>Trụ sở chính: 123 Nam kỳ
                                        khởi nghĩa, Đà Nẵng
                                    </p>
                                    <p>Số ĐKKD: FE23456987</p>
                                    <p>Email: support@rozyonline.vn
                                    </p>
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
    <script src="assets/js/filter.js"></script>
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