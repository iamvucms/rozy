<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? 'Tài khoản của bạn'}}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/index.css">
	<link rel="stylesheet" href="../assets/css/cart.css">
	<link rel="stylesheet" href="../assets/css/account.css">
    <link rel="stylesheet" href="../assets/css/slide.min.css">
    <link rel="stylesheet" href="../assets/css/slide.theme.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.theme.min.css">
    <base href="{{url('/')}}">
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
                <div class="centerbanner" id="mobliebanner">
                    <a href="#centerbanner"><img src="../assets/img/topbanner.png"></a>
                </div>
                <!-- breadcrumb -->
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{url('/')}}"><i class="fas fa-home"></i><span> Trang chủ</span></a></li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li><a href="{{url()->route('myAccount')}}"><i class="fas fa-user"></i><span> Tài khoản
                                </span></a></li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li class="active"><a href="{{url()->current()}}"><i class="fas fa-info-circle"></i> Thông tin cá nhân
                            </a></li>

                    </ul>
                </div>
				<!-- endbreadcrumb -->
				<div class="myAccount">
					<div class="rbar">
						<div class="boxAvt">
							<img src="{{url($user->getAvatar() ??'https://png.pngtree.com/svg/20160601/unknown_avatar_182562.png') }}" alt="" class="userAvt"> <br>
							<span class="uName"><b>{{$user->getName()}}</b> </span>
						</div>
						<ul id="menubar">
							<li @if ($branch=="account")
								class=active
							@endif><a href="{{url()->route('myAccount')}}"><i class="fas fa-users-cog"></i> Tài khoản của tôi</a></li>
							<li @if ($branch=="order")
                            class=active
                        @endif><a href="{{url()->route('myOrders')}}"><i class="fas fa-clipboard"></i> Đơn hàng</a></li>
							<li @if ($branch=="notify")
                            class=active
                        @endif><a href="{{url()->route('myNotify')}}"><i class="fas fa-bell"></i> Thông báo</a></li>
							<li><a href="{{url()->route('logout')}}"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a></li>
						</ul>
					</div>
					<div class="manageBox">
						<div class="mAccount" @if ($branch=="account")
                        style="display:block"
                        @endif >
							<div class="mtitle">
								<h3>Hồ sơ của tôi</h3>
								<small style="color:#333">Quản lý thông tin hồ sơ để bảo mật tài khoản</small>
                            </div>
                            @php
                                $errors = $errors->toArray();
                            @endphp
							<div class="mflex">
								<div class="mTable">
									
								<form enctype="multipart/form-data" action="{{url()->route('updateAccount')}}" method="POST">
									@csrf
										<table >
										<tr>
                                            <td>Tên</td>
                                            <td><input @if (isset($errors['name']))
                                                class=error
                                            @endif type="text" name="name" value="{{$user->getInfo()->name}}">
                                            </td>
										</tr>
										<tr>
											<td>Số Điện Thoại</td>
											<td><input  @if (isset($errors['phone']))
                                                class=error
                                            @endif type="text" name="phone" value="{{$user->getInfo()->phone}}"></td>
										</tr>
										<tr>
											<td>Địa Chỉ</td>
											<td><input @if (isset($errors['address']))
                                                class=error
                                            @endif type="text" name="address" value="{{$user->getInfo()->address}}"></td>
										</tr>
										<tr>	
											<td>Giới Tính</td>
											<td><input type="radio" name="gender" value="1" @if ($user->getInfo()->gender==1)
												checked=checked
											@endif> Nam
												<input type="radio" name="gender" value="2" @if ($user->getInfo()->gender==2)
												checked=checked
											@endif> Nữ</td>
										</tr>
										<tr>
											<td>Mật Khẩu Mới</td>
											<td><input @if (isset($errors['pass']) || isset($errors['cpass']))
                                                class=error
                                            @endif type="password" name="pass""></td>
										</tr>
										<tr>
											<td>Nhập Lại Mật Khẩu</td>
											<td><input @if (isset($errors['pass']) || isset($errors['cpass']))
                                                class=error
                                            @endif type="password" name="cpass""></td>
										<tr>
											<td></td>
											<td><button type="submit">Cập Nhật</button></td>
										</tr>
									</table>
								
							</div>
							<div class="avtArea">
							<img id="currentAvt" class="userAvt" src="{{url($user->getAvatar() ??'https://png.pngtree.com/svg/20160601/unknown_avatar_182562.png') }}" alt=""><br>
								<label for="avatar" id="btnAvatar">Chọn Ảnh</label>
								<input onchange="readURL(this)" accept="image/gif, image/jpeg, image/png" style="display:none" type="file" name="avatar" id="avatar"><br>
								<small class="updatenote" >
									Định dạng:.JPEG, .PNG
								</small>
							</div>
							<script>
								function readURL(input) {
									if (input.files && input.files[0]) {
										var reader = new FileReader();
										reader.onload = function (e) {
											document.querySelector('#currentAvt').setAttribute('src',e.target.result)
										};
										reader.readAsDataURL(input.files[0]);
									}
								}
							</script>
							</div>
						</form>
                        </div>
                        <div class="mOrder" @if ($branch=="order")
                            style="display:block"
                            @endif>
                            <div class="mFlex">
								<ul id="mTab">
                                    <li onclick="document.querySelector('#mTab li.active').removeAttribute('class'); this.setAttribute('class','active');switchTab(this.dataset.tab)" class="active" data-tab="0">Tất cả</li>
                                    <li onclick="document.querySelector('#mTab li.active').removeAttribute('class'); this.setAttribute('class','active');switchTab(this.dataset.tab)" data-tab="1">Chờ xác nhận</li>
                                    <li onclick="document.querySelector('#mTab li.active').removeAttribute('class'); this.setAttribute('class','active');switchTab(this.dataset.tab)" data-tab="2">Chờ lấy hàng</li>
                                    <li onclick="document.querySelector('#mTab li.active').removeAttribute('class'); this.setAttribute('class','active');switchTab(this.dataset.tab)" data-tab="3">Đang giao</li>
                                    <li onclick="document.querySelector('#mTab li.active').removeAttribute('class'); this.setAttribute('class','active');switchTab(this.dataset.tab)" data-tab="4">Đã giao</li>
                                    <li onclick="document.querySelector('#mTab li.active').removeAttribute('class'); this.setAttribute('class','active');switchTab(this.dataset.tab)" data-tab="5">Đã huỷ</li>
                                </ul>
                               
                                <div class="trline" style="height:3px;background:#ddd;margin-top:25px"></div>
                                <div class="orderBox">
                                    @foreach ($orders ?? [] as $order)
                                <div class="order" data-tab="{{$order->status}}">
                                            <div class="shopLine">
                                                <div class="shopInfo">
                                                    <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png" alt="" class="shopavt">
                                                    <span class="shopName">{{$order->Seller->name}}</span>
                                                    <button><a href="{{url()->route("shop",['slug'=>$order->Seller->slug])}}"><i class="fas fa-store"></i> Xem shop</a></button>
                                                </div>
                                                <div class="ostt">
                                                    <span>@switch($order->status)
                                                        @case('1')
                                                            Chờ xác nhận
                                                            @break
                                                        @case('2')
                                                            CHỜ LẤY HÀNG
                                                            @break
                                                        @case('3')
                                                            ĐANG GIAO
                                                            @break 
                                                        @case('4')
                                                            ĐÃ GIAO
                                                            @break 
                                                        @case('5')
                                                            ĐÃ HỦY
                                                            @break 
                                                        @default
                                                            
                                                    @endswitch</span>
                                                </div>
                                            </div>
                                            <div class="productLine">
                                                @foreach ($order->getOrderDetails() ?? [] as $detail)
                                                <div class="oProduct">
                                                    <div class="imgPro">
                                                    <img src="{{url($detail->getProduct()->Avatar()->src ?? '')}}" alt="">
                                                    </div>
                                                    <div class="namePro">
                                                    <p><a href="{{url('/products/'.$detail->getProduct()->slug)}}" style="color:#4166b2">{{$detail->getProduct()->name}}</a></p>
                                                        <p>Số lượng: {{$detail->quantity}} </p>
                                                    </div>
                                                    <div class="pricePro">
                                                    <span>{{number_format($detail->quantity*$detail->getProduct()->sale_price)}} đ</span>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="optionLine">
                                                <div class="total">
                                                    <span>Tổng số tiền: <span class="bigPrice">
                                                            {{number_format($order->total)}} đ</span></span>
                                                </div>
                                                <div class="groupBtn">
                                                    <button onclick="console.log(this.parentElement.parentElement.childNodes[5].style.display='flex')">Chi Tiết</button>
                                                    <button onclick="CancelOrder({{$order->id}})">Huỷ Đơn Hàng</button>
                                                </div>
                                                <div class="oDetail">
                                                    <div class="oAddress">
                                                        <h3>ID ĐƠN HÀNG: <span style="color:#ee4d2d">{{strtoupper($order->slug)}}</span></h3>
                                                        <h2>Thông tin người nhận</h2>
                                                        <p class="oName">{{$order->name}}</p>
                                                        <p>Điện thoại: <b style="color:black">{{$order->phone}}</b></p>
                                                        <p>Địa chỉ: <b style="color:black">{{$order->address}}</b></p>
                                                    </div>
                                                    <div class="oPrice">
                                                        <h2>Chi tiết thanh toán</h2>
                                                        <table>
                                                            <tr>
                                                                <td>Tổng tiền hàng</td>
                                                            <td>{{number_format($order->getProductsPrice())}} đ</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Vận chuyển-{{$order->getShipper()->name}}</td>
                                                                <td>{{number_format($order->ship_price)}} đ</td>
                                                            </tr>
                                                            @if ($order->coupon_price>0)
                                                            <tr>
                                                                <td>Mã giảm giá</td>
                                                                <td>-{{number_format($order->Coupon()->value)}} đ</td>
                                                            </tr>
                                                            @endif
                                                           

                                                            <tr>
                                                                <td>Tổng cộng</td>
                                                                <td>{{number_format($order->total)}} đ</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @endforeach
                                </div>
                                <script>
                                    function switchTab(type){
                                        let orders = document.querySelectorAll('.order')
                                        orders.forEach(order=>{
                                            console.log(order)
                                            if(type=="0"){
                                                order.style.display = 'block'
                                            }else{
                                                if(order.dataset.tab==type) order.style.display = 'block'
                                                else order.style.display = 'none'
                                            }
                                        })
                                    }
                                    function CancelOrder(id){
                                        axios.put('{{url('/orders')}}/'+id,{
                                            status:5
                                        }).then((data)=>{
                                            window.location.reload()
                                        })
                                    }
                                </script>
                            </div>
                        </div>
                        
                        <div class="mNotify" @if ($branch=="notify")
                            style="display:block"
                            @endif>
                            <div class="mtitle" style="padding:15px">
								<h3>Thông báo của bạn</h3>
								<small style="color:#333">Kiểm tra các thông báo của bạn.</small> 
                            </div>
                            <div class="notifyBox"> 
                                @foreach ($notifications ?? [] as $notify)
                                    <div class="notify">
                                        <div class="notifyImg imgPro">
                                            <img src="{{url($notify->Image()->src ?? '')}}" alt="">
                                        </div>
                                        <div class="notifyMsg">
                                            <h3 class="title">{{$notify->title}}</h3>
                                            <p class="msg">{{$notify->message}}</p>
                                            <p class="created_at">{{$notify->created_at}}</p>
                                        </div>
                                        <div class="btnViewed">
                                            <button onclick="NofityViewed({{$notify->id}})">ĐÁNH DẤU LÀ ĐÃ ĐỌC</button>
                                        </div>
                                    </div>
                                @endforeach
                                <script>
                                    function NofityViewed(id){
                                        axios.put('{{url()->route('viewNotify')}}',{
                                            id:id
                                        }).then(data=>{
                                            window.location.href = '{{url()->route('myAccount')}}';
                                        })
                                    }
                                </script>
                            </div>
                        </div>
					</div>
				</div>
                <!-- flashsales -->
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

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/slide.min.js"></script>
    <script src="../assets/js/lazy.js"></script>
    <!-- <script src="../assets/js/lazy.plugin.js"></script> -->
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets/js/cart.js"></script>
    <script src="../../../assets/js/socket.io.js"></script>
    <script src="../../../assets/js/socket.init.js"></script>
    <script>
        var getMsgURI = '{{url()->route('getMsgBySeller')}}'
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
		@if($user)
			socketAuth({{$user->id}},1,'{{$user->password}}')
		@endif
	</script>
</body>
</html>