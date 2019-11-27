<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/cat.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/product.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../assetsAdmin/css/chart.min.css">
    <script src="../../../assets/js/socket.io.js"></script>
    <script src="../../../assets/js/socket.init.js"></script>
    <script src="../../assets/js/axios.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Products</title>
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
                                        @if($msg->position==2) 
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
                <div class="headtitle">
                    <p>SẢN PHẨM</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Sản Phẩm</a></span></li>

                        </ul>
                    </div>
                    <div class="groupbtn">
                        <a href="{{url()->route('superAddProduct')}}" class="add"><button id="add">+</button></a>
                        <a href="" class="f5"><button id="f5"><i class="fas fa-sync"></i></button></a>
                        <a href="javascript:void(0)" onclick="deleteSelected()" class="remove"><button id="remove"><i
                                    class="far fa-trash-alt"></i></button></a>
                    </div>
                </div>
                <div class="catlist">
                    <p class="cattitle">
                        <i class="fas fa-list-ul"></i> Danh Sách Sản Phẩm
                    </p>
                    <div class="tabcat" id="listbox">
                        <table border="1">
                            <tr>
                                <th><input type="checkbox" id="checkall"></th>
                                <th>Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Nhà cung cấp</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($products as $product)
                            <tr>
                                <td><input data-idcat="{{$product->id}}" type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="{{url($product->Avatar()->src ?? '')}}" alt=""></p>
                                </td>
                                <td><a href="{{url()->route('superGetProduct',['id'=>$product->id])}}">{{$product->name}}</a></td>
                                <td>{{$product->Seller()->name}}</td>
                                <td>{{number_format($product->sale_price)}} <sup>VND</sup></td>
                                <td>
                                    @if($product->quantity >= 30)
                                        <p><span>{{$product->quantity}}</span></p>
                                    @elseif($product->quantity <=0)
                                        <p class="dan"><span>{{$product->quantity}}</span></p>    
                                    @else
                                        <p class="war"><span>{{$product->quantity}}</span></p> 
                                    @endif
                                </td>
                                <td>
                                    @switch($product->status)
                                        @case(1)
                                        <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                            @break
                                        @case(2)
                                        <p class="sellstt" id="hethang">Hết Hàng</p>
                                            @break
                                        @default
                                        <p class="sellstt" id="stopsell">Ngừng Kinh Doanh</p>
                                    @endswitch
                                </td>
                                <td><a href="{{url()->route('superGetProduct',['id'=>$product->id])}}"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="paginationx">
                            {{$products->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="../../../../assets/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script>
        function deleteSelected(){
            if(selectedCat.length ==0) return;
            if(confirm('Bạn có chắc muốn xoá '+selectedCat.length+' sản phẩm này') ){
                axios.post('{{url()->route('superDeleteEditProduct')}}',{
                    ids:selectedCat
                }).then(d=>{
                    data = d.data
                    window.location.reload()
                })  
            }   
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