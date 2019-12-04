<!DOCTYPE html>
<html lang="en">
@extends('includes.head')
@section('title',$product->name)

<body>
    <div class="rozy">
        <div class="rvBox">
            <form action="{{url()->route('createReview',['idproduct'=>$product->id])}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <label for="txtReview">Nội dung:</label>
                <br>
                <textarea placeholder="Tối thiểu 30 kí tự" minlength="30" required name="content" id="txtReview"
                    cols="30" rows="5" style="width:100%;padding:10px;font-size:1em;margin-top:15px"></textarea>
                <div class="rvStar">
                    <span>Đánh giá :</span>
                    <input name="rvStar" type="radio" value="1" id="star1" checked>
                    <label for="star1"><i class="fas fa-star" id="star"></i></label>
                    <input name="rvStar" type="radio" value="2" id="star2">
                    <label for="star2"><i class="fas fa-star" id="star"></i></label>
                    <input name="rvStar" type="radio" value="3" id="star3">
                    <label for="star3"><i class="fas fa-star" id="star"></i></label>
                    <input name="rvStar" type="radio" value="4" id="star4">
                    <label for="star4"><i class="fas fa-star" id="star"></i></label>
                    <input name="rvStar" type="radio" value="5" id="star5">
                    <label for="star5"><i class="fas fa-star" id="star"></i></label>
                </div>
                <input onchange="readURL(this)" accept="image/gif, image/jpeg, image/png" style="display:none"
                    id="rvImg" type="file" name="rvImages[]" multiple>
                <p>Thêm hình ảnh <span style="color:rgba(0,0,0,0.5)">(Tối đa được chọn 5 ảnh)</span></p>
                <div class="showRvImg">
                    <label for="rvImg" id="lblRvImg">+</label>
                </div>
                <button type="submit">Đăng đánh giá</button>
                <button style="background:red"
                    onclick="document.querySelector('.rvBox').style.display='none';return false;">Huỷ</button>
            </form>
            <script>
                function readURL(input) {
                    if (input.files) {
                        if (input.files.length > 5) {
                            alert('Tối đa được chọn 5 ảnh');
                            input.files = []
                            return;
                        }
                        document.querySelector('.showRvImg').innerHTML = '<label for="rvImg" id="lblRvImg">+</label>'
                        for (let img of input.files) {
                            let reader = new FileReader();
                            reader.onload = function (e) {
                                strImg = '<img class="imgRe" src="' + e.target.result + '">'
                                document.querySelector('.showRvImg').innerHTML = document.querySelector('.showRvImg').innerHTML + strImg
                            }
                            reader.readAsDataURL(img);
                        }

                    }
                }
                document.querySelectorAll('.rvStar input').forEach(v => {
                    v.onchange = () => {
                        for (i = 5; i >= 1; i--)
                            document.querySelector('label[for="star' + i + '"]').style.color = 'rgba(255, 255, 0, 0.5)'
                        for (i = v.value; i >= 1; i--) {
                            document.querySelector('label[for="star' + i + '"]').style.color = 'orange'
                        }
                    }
                })
            </script>
        </div>
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
                        <div class="mobilelogo"><a href="{{url('')}}"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <!-- boxsearch -->
                        <div class="boxsearch">
                            <form action="{{url('/search')}}">
                                <input autocomplete="off" name="keyword" placeholder="Nhập từ khóa sản phẩm..."
                                    type="search" class="searchinput">
                                <button onclick="" class="searchnow micnow"><span><i
                                            class="fas fa-microphone"></i></span>
                                </button>
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
                            
                            <p>CHI TIẾT SẢN PHẨM</p>
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
                        <li><a href="{{url('')}}"><i class="fas fa-home"></i><span> Trang chủ</span></a></li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li><a href="{{url('/search?cat='.$product->getCategory()->id)}}"><i
                                    class="fas fa-mobile-alt"></i><span> {{$product->getCategory()->name}}</span></a>
                        </li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li class="active"><a href=""><i class="fas fa-shopping-cart"></i> {{$product->name}}</a>
                        </li>

                    </ul>
                </div>
                <!-- endbreadcrumb -->
                <!-- productmain -->
                <div class="productmain">
                    <div class="gallery">
                        <div class="mainphoto">
                            <a href="#"><img id="mainimg"
                                    src="{{isset($product->Avatar()->src) ? url($product->Avatar()->src) : '../assets/img/product5.jpg'}}"
                                    alt=""></a>
                        </div>
                        <div class="photolist">
                            <button class="left"><i class="fas fa-chevron-left"></i></button>
                            <button class="right"><i class="fas fa-chevron-right"></i></button>
                            <div class="owl-carousel owl-theme" id="keyslider">
                                @php
                                $Images = $product->Images();
                                $Images->push($product->Avatar());
                                $Images =$Images->reverse()
                                @endphp
                                @foreach ($Images as $Img)
                                <div class="item">
                                    <li class="active"><img src="{{url($Img->src ?? '')}}" alt=""></li>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="order">
                        <div class="pname">
                            <h1>
                                {{$product->name}}
                            </h1>
                        </div>
                        <div class="votecount">
                            <p>
                                @for ($i = 1; $i <= $product->getAvgReview(); $i++)
                                    <i class="fas fa-star" style="color:orange" id="star"></i>
                                    @endfor
                                    @for ($i = 1; $i <= 5-$product->getAvgReview(); $i++)
                                        <i class="fas fa-star" id="star"></i>
                                        @endfor
                                        <span id="review_count"><a href="#viewvotes"
                                                id="scroll2review">{{$product->getCountReview()}} Đánh giá</a></span>
                            </p>
                            <span id="salecount"><i class="fas fa-tags"></i>
                                (<b>{{$product->getTotalQuantitySelled()}}</b>) đã bán</span>
                        </div>
                        <div class="ordertool">
                            <div class="pprice">
                                @php
                                $discount = $product->AvailableDiscount()->get();
                                @endphp
                                @if (count($discount)>0)
                                <span class="newp">
                                    {{number_format($product->price-$discount[0]->percent/100*$product->price)}}
                                    <sup>đ</sup>
                                </span>
                                <span class="oldp">
                                    {{number_format($product->price)}} <sup>đ</sup>
                                </span>
                                <span class="discount">Giảm {{$discount[0]->percent}}%</span>
                                @else
                                <span class="newp">{{number_format($product->price)}} <sup>đ</sup></span>
                                @endif


                            </div>
                            <div class="traninfo">
                                <span><i class="fas fa-history"></i></span>
                                <p>NHẬN HÀNG TRONG 2 GIỜ - ĐỔI TRẢ 24 GIỜ </p>
                            </div>
                            {{-- <div class="colorpick">
                                <span class="ctitle">
                                    Màu sắc:
                                </span>
                                <ul class="listcolors">
                                    <li class="orange " style="background:gold"></li>
                                    <li class="black active" style="background:black"></li>
                                    <li class="blue" style="background:#007ff0"></li>
                                </ul>
                            </div> --}}
                            <form action="{{url()->route('addCart')}}" method=POST onsubmit="return false;">
                                <div class="quantity">
                                    <span class="qtitle">
                                        SỐ LƯỢNG:
                                    </span>
                                    <div class="updowngroup" data-max={{$product->quantity}}>
                                        <button>–</button>
                                        <input id="quantity" name="quantity" type="text" value="1">
                                        <button>+</button>
                                    </div>
                                    <span class="amout">
                                        {{$product->quantity}} sản phẩm có sẵn
                                    </span>
                                </div>
                                <div class="orderbtn">
                                    <span><a href="#addlove"><i class="far fa-heart"></i> Thêm vào danh sách yêu
                                            thích</a></span>
                                    <div style="margin-top:15px;display:flex">
                                        <button style="min-width:193px;margin-right:5px" id="btnAddCart"
                                            onclick="addCart()"><i class="fas fa-cart-plus"></i> Thêm vào giỏ
                                            hàng</button>
                                        <button><i class="far fa-money-bill-alt"></i> Mua ngay</button>
                                    </div>

                                </div>
                            </form>
                            <script>

                                function addCart() {
                                    let preCount = {{ $myCart-> getQuantityAll()
                                }}

                                let btnAddCart = document.querySelector('#btnAddCart')
                                btnAddCart.innerHTML = ' <img style="width:45px" src="{{asset('assets/img/loading.svg')}}" alt="">'
                                let quan = parseInt(document.querySelector('#quantity').value)
                                let id = {{ $product-> id}}
                                axios.post('{{url()->route('addCart')}}', {
                                    id: id,
                                    quantity: quan
                                }).then(data => {
                                    setTimeout(() => {
                                        btnAddCart.innerHTML = '<i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng';
                                        if (data.data.success) {
                                            let count = 0;
                                            let total = 0;
                                            let stringLi = ''
                                            data.data.dataCart.map(product => {
                                                total += product.quantity * product.price
                                                count += product.quantity
                                                stringLi += '<li><img src="../' + product.avatar + '" alt="" class="cartimg"><span class="cartname"><a href="#">' + product.name + ' </a></span><span class="cartinfo"><span class="cartcost">' + new Intl.NumberFormat('ja-JP').format(product.price) + ' <sup>VND</sup></span> x<span class="quantity">' + product.quantity + '</span></span><span class="closecart" onclick="delCart(' + product.id + ');this.parentElement.parentElement.removeChild(this.parentElement)">×</span></li>'
                                            })
                                            total = new Intl.NumberFormat('ja-JP').format(total)
                                            let totalString = '<li class="carttotal"><span> Tổng cộng: ' + total + ' <sup>VND</sup></span></li><div class="groupcartbtn"><button class="btnviewcart"><a href="{{url('/cart')}}">Xem giỏ hàng</a></button><button class="btncartpay"><a href="{{url('/payment')}}">Thanh toán ngay</a></button></div>'
                                            if (preCount == 0) {
                                                document.querySelector('#cartProducts').innerHTML = stringLi + totalString
                                            } else {

                                                document.querySelector('#cartProducts').innerHTML = stringLi
                                            }
                                            document.querySelector('#cartCount').innerHTML = count
                                            document.querySelector('#myCart').setAttribute('style', 'display:block')
                                            document.querySelector('#totalCart').innerHTML = total
                                            setTimeout(() => {
                                                document.querySelector('#myCart').removeAttribute('style')
                                            }, 5000);
                                        }
                                    }, 1000);
                                })
                                }
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
                            <div class="note">

                            </div>
                            <div class="sharetool">
                                <ul> <span>Chia sẻ sản phẩm này </span>
                                    <a href="#share">
                                        <li style="color:#4166b2;"><i class="fab fa-facebook-square"></i></li>
                                    </a>
                                    <a href="#share">
                                        <li style="color:#1da1f2"><i class="fab fa-twitter-square"></i></li>
                                    </a>
                                    <a href="#share">
                                        <li style="color:#e60023"><i class="fab fa-pinterest-square"></i></li>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="shop">
                        <div class="shopname">
                            <i class="fas fa-store-alt"></i>
                            <span>
                                <a href="{{url('/shop/'.$product->Seller()->slug)}}">{{$product->Seller()->name}}</a>
                                <br>
                                <small>Cam kết chính hiệu 100%</small>
                            </span>
                            <a href="{{url('/shop/'.$product->Seller()->slug)}}" id="viewshop" class="tabfade">
                                <button class="viewshop">
                                    <small>Xem shop</small>
                                </button>
                            </a>
                        </div>
                        @if ($product->Seller()->is_verify==1)
                        <div class="cefi">
                            <i class="fas fa-user-check"></i>
                            <small>Shop đã được xác minh đạt tiêu chuẩn bán hàng tại Rozy</small>
                        </div>
                        @endif
                        <div class="award">
                            <ul><span></span>
                                <li><i class="fas fa-tshirt"></i>
                                    <span>
                                        <b>{{$product->Seller()->getTotalProducts()< 1000 ? $product->Seller()->getTotalProducts() : $product->Seller()->getTotalProducts()/1000 ."k"}}</b><br>
                                        <small>Sản phẩm</small>
                                    </span>
                                </li>
                                <li><i class="far fa-comment-alt"></i>
                                    <span>
                                        <b>90%</b><br>
                                        <small>Tỉ lệ phản hồi</small>
                                    </span>
                                </li>
                                <li><i class="fas fa-vote-yea"></i>
                                    <span>
                                        @php
                                        $countReview = $product->Seller()->getTotalReviewsThan(3)
                                        @endphp
                                        <b>{{$countReview<1000 ?$countReview : $countReview/1000 ."k"}}</b><br>
                                        <small>Đánh giá > 3 <i class="fas fa-star"></i> </small>
                                    </span>
                                </li>
                                <li><i class="fas fa-tshirt"></i>
                                    <span>
                                        <b>24H</b><br>
                                        <small>Thời gian chuẩn bị</small>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <a href="#viewshop" id="viewshop" class="tabhiden">
                            <button class="viewshop">
                                <small>Xem shop</small>
                            </button>
                        </a>
                        <div class="contactshop">
                            <div class="hotline">
                                <img src="../assets/img/callme.png" alt="">
                                <p>
                                    <b>Liên hệ</b><br>
                                    <small>
                                        Hotline đặt hàng: 0234 5678 98 <br>
                                        (Miễn phí, 8-21h cả T7, CN)
                                    </small>
                                </p>
                            </div>
                            <div class="hotline">
                                <img src="../assets/img/mailme.png" alt="">
                                <p>
                                    <b>Email: </b><br>
                                    <small>support@rozyonline.vn</small>
                                </p>
                            </div>
                        </div>
                        <a href="#chat" class="chatonline">
                            <p>Để giải quyết các thắc mắc của bạn về sản phẩm.</p>
                            <button>
                                Hỏi đáp trực tuyến
                            </button>
                        </a>
                    </div>
                </div>
                <!-- endproductmain -->
                <div class="productinfo">
                    <div class="detailinfo">
                        <div class="dtitle">
                            <p>CHI TIẾT SẢN PHẨM</p>
                        </div>
                        <div class="tableinfo">
                            <table>
                                @foreach ($product->getProps() as $name => $prop)
                                <tr>
                                    <td>{{App\Property::getPropKey($name)}}</td>
                                    <td>{{$prop}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="description">
                        <div class="dtitle">
                            <p>MÔ TẢ SẢN PHẨM</p>
                        </div>
                        <div class="dgroup">
                            <div class="destext">
                                <div class="dslider">
                                    <div class="owl-carousel owl-theme" id="dslider">
                                        @foreach ($product->Slide as $slideImg)
                                        <div class="item">
                                            <a href="javascript:void(0)">
                                                <img src="{{$slideImg->src}}" alt="">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button id="goleft"><i class="fas fa-chevron-left"></i></button>
                                    <button id="goright"><i class="fas fa-chevron-right"></i></button>
                                </div>
                                {!!$product->description!!}
                            </div>
                            <div class="desnumber">
                                <div class="pbanner">
                                    <a href="#"><img src="../assets/img/pbanner1.png" alt=""></a>
                                </div>
                                <div class="pbanner">
                                    <a href="#"><img src="../assets/img/pbanner2.jpg" alt=""></a>
                                </div>
                                {{-- <div class="pbanner">
                                    <a href="#"><img src="../assets/img/pbanner1.png" alt=""></a>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                    <div class="review">
                        <div class="dtitle">
                            <p>ĐÁNH GIÁ SẢN PHẨM</p>
                        </div>
                        <div class="totalreview">
                            <div class="total">
                                <p>Đánh Giá Trung Bình</p>
                                <span class="rate">
                                    {{$product->getAvgReview()}}/5
                                </span>
                                <div class="stars">
                                    <ul>
                                        @for ($i = 1; $i <= $product->getAvgReview(); $i++)
                                            <li><i class="fas fa-star" style="color:orange"></i></li>
                                            @endfor
                                            @for ($i = 1; $i <= 5-$product->getAvgReview(); $i++)
                                                <li><i class="fas fa-star" style="color:#acacac"></i></li>
                                                @endfor
                                    </ul>
                                </div>
                                <span class="ratecount" style="color:#acacac">({{$product->getCountReview()}} Đánh
                                    giá)</span>
                            </div>

                            <div class="statis">
                                <div class="liststatis">
                                    <ul>
                                        @php
                                        $i = 5;
                                        @endphp
                                        @foreach ($product->getPercentReview() as $percent)
                                        <li>
                                            <span>{{$i--}} <i class="fas fa-star" style="color:orange"></i></span>
                                            <div class="ratebar">
                                                <p style=" width:{{100-$percent}}%;"></p>
                                            </div>
                                            <span>{{$percent}}%</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="writereview">
                                <div>
                                    <p>Chia sẻ nhận xét về sản phẩm</p>
                                    <button onclick="document.querySelector('.rvBox').style.display='block';"><i
                                            class="fas fa-pen-alt"></i> Nhận xét về sản phẩm</button>
                                </div>
                            </div>
                        </div>
                        <div class="reviewlist">
                            <div class="rvtitle">
                                <p>Nhận xét</p>
                            </div>
                            <div class="rvlist">
                                @foreach ($product->Review->paginate(10) as $review)
                                <div class="rv">
                                    <div class="rvauthor">
                                        <img src="{{url($review->Customer()->first()->getAvatar() ?? '')}}" alt="">
                                        <div>
                                            <p>{{$review->whoWrite()}}</p>
                                            <p>
                                                @for ($i = 1; $i <= $review->star; $i++)
                                                    <span><i class="fas fa-star" style="color:orange"
                                                            id="star"></i></span>
                                                    @endfor
                                                    @for ($i = 1; $i <= 5-$review->star; $i++)
                                                        <span><i class="fas fa-star" id="star"></i></span>
                                                        @endfor
                                            </p>
                                            <p class="rvcontent">{{$review->message ?? ''}}</p>

                                            <p class="rvgallery">
                                                @foreach ($review->Images as $rvimg)
                                                <img src="{{url($rvimg->src ?? '')}}" alt="{{$product->name}}">
                                                @endforeach
                                            </p>
                                            <p class="rvat">
                                                <i class="far fa-clock"> </i>
                                                {{date_format(date_create($review->create_at),"H:i:s d-m-Y")}}
                                            </p>
                                        </div>
                                        <a href="javascript:void(0)"
                                            onclick="@if(array_search($review->id,Session::get('point_increment_ids') ?? [])===false)increPoint({{$review->id}})@endif"><button><i
                                                    class="far fa-thumbs-up"></i> <span><b id="rvPoint_{{$review->id}}"
                                                        data-point="{{$review->point}}">{{$review->point}}</b> Hữu
                                                    ích</span></button></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <script>
                            function increPoint(id) {
                                axios.post('{{url()->route('increPoint')}}', {
                                    id: id
                                }).then(d => {
                                    data = d.data
                                    if (data.success) {
                                        rv = document.querySelector('#rvPoint_' + id)
                                        rv.dataset.point = parseInt(rv.dataset.point) + 1
                                        rv.innerHTML = rv.dataset.point
                                    }
                                })
                            }
                        </script>
                        <div class="btnloadmore" id="pagination">
                            {{$product->Review->paginate(10)->links()}}
                        </div>
                    </div>

                </div>
                <!-- categoriesforyou -->

                <!-- endsearchtrending -->
                <div class="flashsales" id="foryou">
                    <div class="salestitle">
                        CÓ THỂ BẠN CŨNG THÍCH
                    </div>
                    <div class="salesproducts" id="foryou">
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
                                let preCount = {{ $myCart-> getQuantityAll()
                            }}
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
                            function addLove(id) {
                                axios.post('{{url()->route('addEnjoy')}}', {
                                    id: id,
                                    type: 1
                                }).then(data => {
                                    data = data.data
                                    if (data.success) {

                                    }
                                })
                            }
                            function delLove(id) {
                                axios.post('{{url()->route('delEnjoy')}}', {
                                    id: id,
                                }).then(data => {
                                })
                            }
                        </script><!-- endrightoption -->
                    </div>
                </div>
            </div>
            <!-- endbodycenter -->

        </div>
        <!-- endbody -->
        <!-- footer -->
        @extends('includes.footer')
    <script src="../../assets/js/jquery.min.js"></script>
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