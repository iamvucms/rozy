<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{strtoupper($seller->name)}}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
    <link rel="stylesheet" href="../assets/css/filter.css">
    <link rel="stylesheet" href="../assets/css/shop.css">
    <link rel="stylesheet" href="../assets/css/slide.min.css">
    <link rel="stylesheet" href="../assets/css/slide.theme.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.theme.min.css">
    <script src="../assets/js/axios.js"></script>

</head>

<body>
    <div class="rozy">

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
                                    <li><a href="result.html"><img src="../assets/img/denwa.png"><span>SamSung Galaxy
                                                A30</span></a></li>
                                    <li><a href="result.html"><img src="../assets/img/product1.png"><span>iPhone
                                                X</span></a></li>
                                    <li><a href="result.html"><img src="../assets/img/product.jpg"><span>Móc
                                                Khóa</span></a></li>
                                    <li><a href="result.html"><img
                                                src="../assets/img/product2.jpg"><span>SmartPhone</span></a></li>
                                    <li><a href="result.html"><img src="../assets/img/product4.jpg"><span>Chuột Máy
                                                Tính</span></a></li>
                                    <li><a href="result.html"><img src="../assets/img/product5.jpg"><span>Đồng
                                                Hồ</span></a></li>
                                    <li><a href="result.html"><img src="../assets/img/mega14.jpg"><span>Sách Hay</span></a>
                                    </li>
                                    <li><a href="result.html"><img src="../assets/img/denwa.png"><span>Điện
                                                Thoại</span></a></li>
                                    <li><a href="result.html"><img src="../assets/img/bike.png"><span>Xe máy
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
                                    <img src="../assets/img/product1.png" alt="" class="cartimg">
                                    <span class="cartname"><a href="#">Galaxy S6 32Gb 3Gb Ram abc xyz </a></span>
                                    <span class="cartinfo">
                                        <span class="cartcost">10,000,000 <sup>VND</sup></span> x
                                        <span class="quantity">1</span>
                                    </span>
                                    <span class="closecart">×</span>
                                </li>
                                <li>
                                    <img src="../assets/img/mega6.jpg" alt="" class="cartimg">
                                    <span class="cartname"><a href="#">Iphone X 64 GB Ram 4Gb</a></span>
                                    <span class="cartinfo">
                                        <span class="cartcost">20,000,000 <sup>VND</sup></span> x
                                        <span class="quantity">1</span>
                                    </span>
                                    <span class="closecart">×</span>
                                </li>

                                <li>
                                    <img src="../assets/img/product1.png" alt="" class="cartimg">
                                    <span class="cartname"><a href="#">Galaxy S6 32Gb 3Gb Ram abc xyz </a></span>
                                    <span class="cartinfo">
                                        <span class="cartcost">10,000,000 <sup>VND</sup></span> x
                                        <span class="quantity">1</span>
                                    </span>
                                    <span class="closecart">×</span>
                                </li>
                                <li>
                                    <img src="../assets/img/mega6.jpg" alt="" class="cartimg">
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
                                    <button class="btnviewcart"><a href="cart.html">Xem giỏ hàng</a></button>
                                    <button class="btncartpay"><a href="payment.html">Thanh toán ngay</a></button>
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
            <div class="bottomtool">
                <span><i class="fas fa-filter"></i> <a class="tabhiden" href="javascript:void(0)">Bộ Lọc</a> <i
                        class="fas fa-angle-double-right" id="mobliehiden"></i>
                    <div class="leftpoll">
                        <div class="allfilter">
                            <div class="categories" id="allcats">
                                <p><i class="fas fa-list-ul"></i> TẤT CẢ DANH MỤC
                                </p>
                                <p class="parentcat"><i class="fas fa-caret-right"></i>
                                    Thời trang nam</p>
                                <li><a href="javascript:void(0)">Áo thun</a></li>
                                <li><a href="javascript:void(0)">Áo sơ mi</a></li>
                                <li><a href="javascript:void(0)">Quần jean</a>
                                </li>
                                <li><a href="javascript:void(0)">Áo vest</a></li>
                                <li><a href="javascript:void(0)">Quần shorts</a>
                                </li>
                                <ul class="hidecats">
                                    <li><a href="javascript:void(0)">Áo
                                            thun</a></li>
                                    <li><a href="javascript:void(0)">Áo sơ
                                            mi</a></li>
                                    <li><a href="javascript:void(0)">Quần
                                            jean</a></li>
                                    <li><a href="javascript:void(0)">Áo
                                            vest</a></li>
                                    <li><a href="javascript:void(0)">Quần
                                            shorts</a></li>
                                </ul>
                                <li class="viewmorecat">Xem thêm <i class="fas fa-sort-down"></i>

                                </li>
                            </div>
                            <div class="categories" id="filtertool">
                                <p><i class="fas fa-filter"></i></i> BỘ LỌC</p>
                                <p class="parentcat"><i class="fas fa-caret-right"></i>
                                    Địa điểm bán</p>
                                <li><a href="javascript:void(0)"><input type="checkbox"> Đà
                                        Nẵng</li>
                                <li><a href="javascript:void(0)"><input type="checkbox"> Hải
                                        Phòng</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox"> Hà
                                        Nội</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox">
                                        Quảng Nam</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox">
                                        TP.Hồ Chí Minh</a></li>
                                <ul class="hidecats">
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Đà Nẵng</li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Hải Phòng</a></li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Hà Nội</a></li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Quảng Nam</a></li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            TP.Hồ Chí Minh</a>
                                    </li>
                                </ul>
                                <li class="viewmorecat">Xem thêm <i class="fas fa-sort-down"></i>

                                </li>
                            </div>

                            <div class="categories" id="costtool">
                                <p class="parentcat"><i class="fas fa-caret-right"></i>
                                    Khoảng giá</p>
                                <div class="groupprice">
                                    <input type="number" class="lowprice" value="100000">
                                    <i class="fas fa-chevron-right breadarrow"></i>
                                    <input type="number" class="highprice" value="200000">
                                </div>
                                <li><a href="javascript:void(0)"> DƯỚI 95K</li>
                                <li><a href="javascript:void(0)"> 95K ~ 100K</a>
                                </li>
                                <li class="active"><a href="javascript:void(0)">
                                        100K ~ 200K</a></li>
                                <li><a href="javascript:void(0)"> 200K ~ 250K</a>
                                </li>
                                <li><a href="javascript:void(0)"> 250K ~ 400K</a>
                                </li>
                                <li><a href="javascript:void(0)"> 400K ~ 500K</a>
                                </li>
                            </div>
                            <div class="categories" id="shiptool">
                                <p class="parentcat"><i class="fas fa-caret-right"></i>
                                    Phương thức vận chuyển</p>
                                <li><a href="javascript:void(0)"><input type="checkbox" name="shiptype">
                                        Chuyển phát hỏa tốc</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox" name="shiptype">
                                        Miễn phí vận chuyển</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox" name="shiptype">
                                        Nhận trong 24h</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox" name="shiptype">
                                        Nhận trong 4h</a></li>
                            </div>
                            <div class="categories" id="chatlieutool">
                                <p class="parentcat"><i class="fas fa-caret-right"></i>
                                    Chất liệu</p>
                                <li><a href="javascript:void(0)"><input type="checkbox">
                                        Cotton 100%</li>
                                <li><a href="javascript:void(0)"><input type="checkbox">
                                        Cotton 200%</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox">
                                        Nỉ</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox">
                                        Kaki</a></li>
                                <ul class="hidecats">
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Cotton 100%</li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Cotton 200%</a></li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Nỉ</a></li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Kaki</a></li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Jean</a></li>
                                </ul>
                                <li class="viewmorecat">Xem thêm <i class="fas fa-sort-down"></i>

                                </li>
                            </div>
                            <div class="categories" id="shirtype">
                                <p class="parentcat"><i class="fas fa-caret-right"></i>
                                    Kiểu</p>
                                <li><a href="javascript:void(0)"><input type="checkbox">
                                        Trơn</li>
                                <li><a href="javascript:void(0)"><input type="checkbox"> Hoa
                                        lá</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox"> Tay
                                        ngắn</a></li>
                                <li><a href="javascript:void(0)"><input type="checkbox">
                                        Rộng chân</a></li>
                                <ul class="hidecats">
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Trơn</li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Hoa lá</a></li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Tay ngắn</a></li>
                                    <li><a href="javascript:void(0)"><input type="checkbox">
                                            Rộng chân</a></li>
                                </ul>
                                <li class="viewmorecat">Xem thêm <i class="fas fa-sort-down"></i>

                                </li>
                            </div>
                            <div class="categories" id="groupfilter">
                                <button>ÁP DỤNG</button>
                                <button>XÓA TẤT CẢ </button>
                            </div>
                        </div>
                    </div>
                </span>
                <span><i class="fas fa-sort-amount-up"></i> Sắp xếp
                    <div class="sortpanel">
                        <form action="" method="get">

                            <li><input type="radio" name="sortbyrole"> <i class="fas fa-sort-numeric-up"></i> Giá cao
                            </li>
                            <li><input type="radio" name="sortbyrole"> <i class="fas fa-sort-numeric-down"></i> Giá thấp
                            </li>
                            <li><input type="radio" name="sortbyrole"> <i class="fas fa-sort-alpha-down"></i> Từ A-Z
                            </li>
                            <li><input type="radio" name="sortbyrole"> <i class="fas fa-sort-alpha-up"></i> Từ Z-A</li>
                            <li><input type="radio" name="sortbyrole"> <i class="fas fa-eye"></i> Lượt xem</li>
                        </form>
                    </div>
                </span>
            </div>
            <!-- bodycenter -->
            <div class="bodycenter">

                <!-- breadcrumb -->
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{url()->route('home')}}"><i class="fas fa-home"></i><span> Trang
                                    chủ</span></a></li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li><a href="#shop"><i class="fas fa-list"></i><span> Cửa hàng</span></a></li>
                        <i class="fas fa-chevron-right breadarrow"></i>
                        <li class="active"><a href="{{url('/shop/'.$seller->slug)}}">
                                {{$seller->name}} </a></li>

                    </ul>
                </div>
                <!-- endbreadcrumb -->
                <div class="shopBox">
                    <div class="headInfo">
                        <div class="Cover" >
                            <div class="coverImg" style="background-image:url({{url($seller->getCover())}})">
                            </div>
                            <div class="coverOption">
                                <div class="shopAvt">
                                    <img src="{{url($seller->getAvatar())}}" alt="">
                                    <div class="intro">
                                    <p class="sName">{{$seller->name}}</p>
                                        <p class="sIntro">{{$seller->short_description}}</p>
                                        <div class="btnIntro">
                                            <button onclick="addToChat()"><i class="far fa-comment-dots"></i> Chat </button>
                                            
                                            <button "><i onclick="if(this.getAttribute('class')=='fas fa-heart'){delLove({{$seller->id}},2);this.setAttribute('class','far fa-heart')}else{addLove({{$seller->id}},2);this.setAttribute('class','fas fa-heart')}" class="@if($enjoy->is_exists($seller->id,2))
                                                fas fa-heart
                                             @else
                                                far fa-heart
                                             @endif"></i> Yêu Thích</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            function addLoveShop(){

                            }
                            function addToChat(){

                            }
                            </script>
                        </div>
                        <div class="statistic">
                            <div class="col1">
                            <p><i class="fas fa-cubes"></i> Sản phẩm: <span>{{$seller->getTotalProducts()}}</span></p>
                                <p><i class="fas fa-truck"></i> Thời gian chuẩn bị hàng: <span>1 Ngày</span></p>
                                <p><i class="far fa-comment-dots"></i> Tỉ Lệ Phản Hồi Chat: <span>95%</span></p>
                                <p><i class="far fa-window-close"></i> Tỉ Lệ Hủy Đơn: <span>1%</span></p>
                            </div>
                            <div class="col2">
                            <p><i class="far fa-star"></i> Đánh Giá: <span>{{$seller->getTotalReviewsThan(0 )}}</span></p>
                            <p><i class="fas fa-file-signature"></i> Tham gia: <span>{{$seller->JoinTime()}} ngày</span></p>
                            <p><i class="fas fa-archive"></i> Đã bán: <span>{{$seller->getTotalSelled()}}</span></p>
                            <p><i class="far fa-eye"></i> Lượt xem sản phẩm: <span>{{$seller->getTotalProductsViewed()}}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="extraInfo">

                    </div>
                </div>
                <div class="shopInfo">
                    <h3>Thông Tin Shop</h3>
                    <div class="boxInfo">
                       
                        <div class="sCover">
                            <img src="{{url($seller->getCover())}}" alt="">
                        </div>
                        <div class="inforText">
                        <p class="shopName">{{$seller->name}}</p>
                            {!!nl2br($seller->description)!!} <br>
                        </div>
                    </div>
                </div>
                <div class="filter">
                    <div class="optioncol">
                        <div class="categories" id="allcats">
                            <p><i class="fas fa-list-ul"></i> TẤT CẢ DANH MỤC
                            </p>
                            <p class="parentcat"><i class="fas fa-caret-right"></i>
                                Thời trang nam</p>
                            <li><a href="javascript:void(0)">Áo thun</a></li>
                            <li><a href="javascript:void(0)">Áo sơ mi</a></li>
                            <li><a href="javascript:void(0)">Quần jean</a>
                            </li>
                            <li><a href="javascript:void(0)">Áo vest</a></li>
                            <li><a href="javascript:void(0)">Quần shorts</a>
                            </li>
                            <ul class="hidecats">
                                <li><a href="javascript:void(0)">Áo
                                        thun</a></li>
                                <li><a href="javascript:void(0)">Áo sơ
                                        mi</a></li>
                                <li><a href="javascript:void(0)">Quần
                                        jean</a></li>
                                <li><a href="javascript:void(0)">Áo
                                        vest</a></li>
                                <li><a href="javascript:void(0)">Quần
                                        shorts</a></li>
                            </ul>
                            <li class="viewmorecat">Xem thêm <i class="fas fa-sort-down"></i>

                            </li>
                        </div>
                    </div>
                    <!-- flashsales -->
                    <div class="flashsales" id="foryou">

                        <div class="stitle">
                            <span><i class="fas fa-sort"></i> Sắp xếp theo</span>
                            <div class="groupsort">
                                <button data-sort="popular"><i class="fas fa-industry"></i> Phổ biến</button>
                                <button data-sort="sales" class="active"><i class="fab fa-hotjar"></i> Bán chạy</button>
                                <button data-sort="date"><i class="fas fa-history"></i> Ngày ra mắt</button>
                                <button data-sort="vote"><i class="fas fa-vote-yea"></i> Đánh giá</button>
                            </div>
                            <div class="groupsortby">
                                <button class="sortby">Sắp xếp theo <i class="fas fa-chevron-down"></i>
                                    <ul>
                                        <li><i class="fas fa-sort-numeric-up"></i> Giá cao</li>
                                        <li><i class="fas fa-sort-numeric-down"></i> Giá thấp</li>
                                        <li><i class="fas fa-sort-alpha-down"></i> Từ A-Z</li>
                                        <li><i class="fas fa-sort-alpha-up"></i> Từ Z-A</li>
                                        <li><i class="fas fa-eye"></i> Lượt xem</li>
                                    </ul>
                                </button>
                            </div>
                        </div>
                        <div class="salesproducts">
                            @foreach ($products as $product)
                            <div class="product">
                                <div class="imgbox">
                                    <a href="#viewflash">
                                        <img src="{{isset($product->Avatar()->src) ? url($product->Avatar()->src) : 'assets/img/product5.jpg'}}"
                                            alt="">
                                    </a>
                                    <div class="groupcart">
                                        <a href="javascript:void(0)"> <button  title="Thêm vào danh sách yêu thích"><i onclick="if(this.getAttribute('class')=='fas fa-heart'){delLove({{$product->id}});this.setAttribute('class','far fa-heart')}else{addLove({{$product->id}});this.setAttribute('class','fas fa-heart')}"
                                                 class="@if($enjoy->is_exists($product->id))
                                                    fas fa-heart
                                                 @else
                                                    far fa-heart
                                                 @endif"></i></button></a>
                                        <a href="#cartoption"> <button onclick="addCartX({{$product->id}})" title="Thêm vào giỏ hàng"><i
                                                 class="fas fa-cart-plus"></i></button></a>
                                     </div>
                                    
                                    <span id="new_trend"><img src="assets/img/new.png" alt=""></span>

                                </div>
                                @php
                                $discount = $product->AvailableDiscount()->get();
                                @endphp
                                @if (count($discount)>0)
                                <div class="salespercent">{{$discount[0]->percent ?? ''}}% </div>
                                @endif

                                <div class="product_name"><a
                                        href="{{url('./products/'.$product->slug)}}">{{$product->name}}</a>
                                </div>
                                <div class="product_price">
                                    @if (count($discount)>0)
                                    <span
                                        class="newprice">{{number_format($product->price-$discount[0]->percent/100*$product->price)}}
                                        <sup>đ</sup></span>
                                    <span class="oldprice">{{number_format($product->price)}} <sup>đ</sup></span>
                                    @else
                                    <span class="newprice">{{number_format($product->price)}} <sup>đ</sup></span>
                                    @endif

                                </div>
                                <div class="rating">
                                    <p>
                                        @for ($i = 1; $i <= $product->getAvgReview(); $i++)
                                            <i class="fas fa-star" style="color:orange" id="star"></i>
                                            @endfor
                                            @for ($i = 1; $i <= 5-$product->getAvgReview(); $i++)
                                                <i class="fas fa-star" id="star"></i>
                                                @endfor
                                                <span id="review_count">({{$product->getCountReview()}})</span>
                                    </p>
                                    <span class="selled"><i class="fas fa-check-double"></i>
                                        {{$product->getTotalQuantitySelled()}}</span>
                                </div>
                                <div class="supaddress">

                                    {{$product->city_address}}
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
                                function addLove(id,type=1){   
                                    axios.post('{{url()->route('addEnjoy')}}',{
                                       id:id,
                                       type:type
                                    }).then(data=>{
                                       data = data.data
                                       if(data.success){
                                          
                                       }
                                    })
                                 }
                                 function delLove(id,type=1){
                                    axios.post('{{url()->route('delEnjoy')}}',{
                                       id:id,
                                       type:type
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
    <script src="../assets/js/filter.js"></script>
</body>

</html>