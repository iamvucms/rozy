<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/cat.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Review</title>
    <script src="../../../assets/js/axios.js"></script>
    <script src="../../../assets/js/socket.io.js"></script>
    <script src="../../../assets/js/socket.init.js"></script>
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
                <div class="headtitle">
                    <p>ĐÁNH GIÁ</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Đánh Giá</a></span></li>

                        </ul>
                    </div>

                </div>
                <div class="tongquan tabcat">
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$reviews->count()}}
                            </p>
                            <p class="dest">
                                Tổng Đánh giá
                            </p>
                        </div>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$countToDay['total']}}
                            </p>
                            <p class="dest">
                                Đánh giá hôm nay
                            </p>
                        </div>
                        <span class="toprightt">
                            <span class="{{$countToDay['percent'] >=100 ? 'up' : 'down'}}">
                                <span class="percentt">{{$countToDay['percent']}}%</span> <i class="fas fa-angle-{{$countToDay['percent'] >=100 ? 'up' : 'down'}}"></i>
                            </span>
                        </span>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$countGood}}
                            </p>
                            <p class="dest">
                                Đánh giá tốt
                            </p>
                        </div>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$coundBad}}
                            </p>
                            <p class="dest">
                                đánh giá tệ
                            </p>
                        </div>
                    </div>

                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{round($avg,1)}}
                            </p>
                            <p class="dest">
                                Số sao trung bình
                            </p>
                        </div>
                        
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{round($avgPoint,1)}}
                            </p>
                            <p class="dest">
                                Điểm trung bình
                            </p>
                        </div>
                    </div>
                </div>
                <div class="catlist">
                    <p class="cattitle">
                        <i class="fas fa-list-ul"></i> Đánh Giá Sản Phẩm
                    </p>
                    <div class="tabcat tabvote" id="listbox">
                        <table border="1">
                            <tr>
                                <th>Tên khách hàng</th>
                                <th>Sản phẩm</th>
                                <th>Sao</th>
                                <th>Điểm</th>
                                <th>Nội dung</th>
                                <th>Thời Gian</th>
                                <th>Xem</th>
                            </tr>
                            @foreach ($reviews as $review)
                            <tr>
                                <td><a href="{{url()->route('superEditCustomer',['id'=>$review->idcus])}}">{{$review->whoWrite()}}</a></td>
                                <td><a href="{{url()->route('superGetProduct',['id'=>$review->Product()->first()->id])}}">{{$review->Product()->first()->name}}</a></td>
                                <td>{{$review->star}} <i class="far fa-star" style="color:orange"></i></td>
                                <td>{{$review->point}}</td>
                                <td>{{$review->message}}</td>
                                <td>{{$review->create_at}}</td>
                                <td><a href="{{url()->route('myProduct',['slug'=>$review->Product()->first()->slug])}}" target="__blank"><button><i class="far fa-eye"></i></button></a></td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="paginationx">
                            {{$reviews->links()}}
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