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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Streaming</title>
    <script src="../../../assets/js/axios.js"></script>
    <script src="../../../assets/js/socket.io.js"></script>
    <script src="../../../assets/js/socket.init.js"></script>
    <script src="https://unpkg.com/peerjs@1.0.0/dist/peerjs.min.js"></script>
</head>
<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right">
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
        <div class="popupStream">
            <div class="boxStreamVideo">
                <video src="" id="popup_video"></video>
            </div>
        </div>
            @include('includes.top')
            <div class="bottom">
                <div class="headtitle">
                    <p>Streaming</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Live Streaming</a></span></li>

                        </ul>
                    </div>
                    <div class="groupbtn">
                        <a href="" class="f5"><button id="f5"><i class="fas fa-sync"></i></button></a>
                        <a onclick="deleteSelected()" href="javascript:void(0)" class="remove"><button id="remove"><i
                                    class="far fa-trash-alt"></i></button></a>
                    </div>
                </div>
                <div class="catlist">
                    <p class="cattitle">
                        <i class="fas fa-list-ul"></i> Live Streaming
                    </p>
                    
                    @if ($user->role_id==1)
                    <div class="tabcat taborder" id="listbox">
                        <table border="1">
                            <tr>
                                <th></th>
                                <th>Tên gian hàng</th>
                                <th>Danh mục LiveStream</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Lần Cuối LiveStream</th>
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($streams as $stream)
                                <tr>
                                    <td><input type="checkbox" data-idcat="{{$stream->id}}"></td>
                                    <td><a href="{{url()->route('superEditSeller',['id'=>$stream->Seller->id])}}">{{$stream->Seller->name}}</a></td>
                                    <td><a href="{{url()->route('superEditCategory',['slug'=>$stream->Category->slug])}}">{{$stream->Category->name}}</a></td>
                                    <td style="max-width:200px">{{$stream->description}}</td>
                                    <td>@if($stream->status==0)Offline @else Online @endif</td>
                                    <td>{{Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($stream->updated_at,'Asia/Ho_Chi_Minh')) <60 ? Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes(Carbon\Carbon::parse($stream->updated_at,'Asia/Ho_Chi_Minh')).' phút' : Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInHours(Carbon\Carbon::parse($stream->updated_at,'Asia/Ho_Chi_Minh')).' giờ'}}  trước</td>
                                    <td>
                                        <div class="lasttd">
                                            <a href="javascript:void(0)" onclick="showDetail({{$stream->status}},'{{$stream->stream_key}}')"><button><i class="far fa-eye"></i></button></a>
                                            <li id="showoption"><i class="fas fa-angle-down"></i>
                                                <ul>
                                                    <li onclick="clearStream('{{$stream->stream_key}}')"><i class="far fa-trash-alt" ></i> Xóa</li>
                                                </ul>
                                            </li>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="paginationx">
                            {{$streams->links()}}
                        </div>
                    </div>
                    @else
                    <div class="streambox">
                        <div class="video">
                            <video id="streamVideo"></video>
                        </div>
                        <div class="postTool">
                            <u><h2>Mô tả Live Streaming</h2></u>
                            <label for="description">Mô tả:</label><br>
                            <textarea style="width:100%;padding:10px"  name="" id="description" cols="30" rows="10"></textarea>
                            <label for=""></label>
                            <select style="width:100%"  class="js-example-basic-single" id="idcat">
                                @foreach ($categories as $cat)
                                <option value="{{$cat->id}}" >{{$cat->name}}</option>
                                @endforeach
                            </select>
                            <button id="finishBtn">Kết Thúc</button>
                            <button id="startBtn">Bắt Đầu</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="../../../assets/js/jquery.min.js"></script>
    @if($user->role_id==3)
    <script src="../../../assets/js/streaming.js"></script>
    @endif
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        @if($user->role_id==1)
        const peer = new Peer( {host: 'localhost', port: 9000, path: '/' });
        @endif
        function clearStream(key){
            console.log(key)
            socket.emit('clearStream',{key:key})
        }
        function showDetail(status,keyStream){
            if(status==0) return;
            const createEmptyAudioTrack = () => {
                const ctx = new AudioContext();
                const oscillator = ctx.createOscillator();
                const dst = oscillator.connect(ctx.createMediaStreamDestination());
                oscillator.start();
                const track = dst.stream.getAudioTracks()[0];
                return Object.assign(track, { enabled: false });
            };
            const createEmptyVideoTrack = ({ width, height }) => {
                const canvas = Object.assign(document.createElement('canvas'), { width, height });
                canvas.getContext('2d').fillRect(0, 0, width, height);
                const stream = canvas.captureStream();
                const track = stream.getVideoTracks()[0];
                return Object.assign(track, { enabled: false });
            };
            let audioTrack = createEmptyAudioTrack();
            let videoTrack = createEmptyVideoTrack({ width:640, height:480 });
            let mediaStream = new MediaStream([audioTrack, videoTrack]);
            let call = peer.call(keyStream,mediaStream)
            call.on('stream',stream=>{
                document.querySelector('.popupStream').style.display = 'flex'
                document.querySelector('.popupStream').onclick = (e)=>{
                    if(e.target.className=='popupStream'){
                        e.target.style.display = 'none'
                    }
                }
                let popup = document.querySelector('#popup_video')
                popup.click()
                popup.srcObject = stream
                popup.play()
            })
            return false
        }
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
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