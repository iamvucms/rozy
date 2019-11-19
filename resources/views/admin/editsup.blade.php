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
    <title>Admin::Suppliers::Update</title>
    <script src="../../../assetsAdmin/ckeditor/ckeditor.js"></script>
    <script src="../../../../assets/js/axios.js"></script>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right">
            <div class="top">
                <ul class="listtop">
                    <li><i class="far fa-bell"></i> <span class="toptext">Thông báo</span>
                    </li>
                    <li><i class="far fa-envelope"></i> <span class="toptext">Tin
                            nhắn</span></li>
                    <li class="topprofile">
                        <img src="../../assetsAdmin/img/avt.jpg" alt="">
                        <span class="nameprofile"><span class="toptext">VuCms</span>
                            <i class="fas fa-angle-down"></i>

                        </span>
                        <ul>
                            <li><i class="fas fa-cogs"></i> <a href="#">&nbsp;
                                    Cài Đặt</a></li>
                            <li><i class="fas fa-id-card-alt"></i> <a href="#">&nbsp; Trang Cá
                                    Nhân</a></li>
                            <li><i class="far fa-envelope"> </i> <a href="#">&nbsp; Tin nhắn của
                                    bạn</a></li>
                            <li><i class="far fa-bell"></i> <a href="#">&nbsp;
                                    Tất cả thông bá</a>o</li>
                            <li><i class="fas fa-sign-out-alt"></i> <a href="#">&nbsp; Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="bottom">
                <div class="headtitle">
                    <p class="sup">NHÀ CUNG CẤP</p>
                    <div class="breadcrumb supbread">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="{{url()->route('superSeller')}}">Nhà Cung Cấp</a></span></li>

                        </ul>
                    </div>
                </div>
                <div class="catlist" id="add">
                    <p class="cattitle">
                        <i class="fas fa-pen-nib"> </i> Cập Nhật Nhà Cung Cấp
                    </p>
                    <div class="tabcat">
                        <form enctype="multipart/form-data" action="{{url()->route('superPostEditSeller',['id'=>$seller->id])}}" method="POST">
                            @csrf
                        <table>
                            <tr>
                                <td>Tên Gian Hàng</td>
                                <td><input required name="name" value="{{$seller->name}}" type="text" placeholder="Tên Gian Hàng"></td>
                            </tr>
                            <tr>
                                <td>Email hiển thị</td>
                                <td><input required name="displayEmail" value="{{$seller->email}}" type="text"  placeholder="Tên Nhà Cung Cấp"></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại hiển thị</td>
                                <td><input required name="displayPhone" value="{{$seller->phone}}" type="text"  placeholder="Tên Nhà Cung Cấp"></td>
                            </tr>
                            <tr>
                                <td>Thành phố</td>
                                <td>
                                    <select required name="city" id="city" onchange="getDistrict()">
                                        @foreach ($city as $c)
                                        <option @if($c->id==$seller->city_id)selected=selected @endif value="{{$c->id}}">{{$c['name']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Quận/Huyện</td>
                                <td>
                                    <select required onchange="getCommune()" name="district" id="district" >
                                        @foreach ($district as $c)
                                        <option @if($c->id==$seller->district_id)selected=selected @endif value="{{$c->id}}">{{$c['name']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Phường/Thị xã</td>
                                <td>
                                    <select required name="commune" id="commune" >
                                        @foreach ($commune as $c)
                                        <option @if($c->id==$seller->commune_id)selected=selected @endif value="{{$c->id}}">{{$c['name']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Đường</td>
                                <td>
                                <input value="{{$seller->street}}" required type="text" name="street" id="street" >
                                </td>
                            </tr>
                            <script>
                            var city = document.querySelector('#city');
                            var district = document.querySelector('#district');
                            var commune = document.querySelector('#commune');
                            var street = document.querySelector('#street');
                            function getDistrict(){
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
                            }
                            </script>
                            <tr>
                                <td>Mô tả ngắn</td>
                                <td><input required name="short_description" value="{{$seller->short_description}}" placeholder="Mô tả ngắn" type="text" name="short_description" required></td>
                            </tr>
                            <tr>
                                <td>Mô tả Nhà Cung Cấp</td>
                                <td><textarea required name="description" id="destext" style="width:100%"
                                        placeholder="Mô tả Nhà Cung Cấp">{{$seller->description}}
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Ảnh đại diện</td>
                                <td>
                                    <img id="avatarImg" src="{{url($seller->getAvatar() ?? '')}}" alt="" width="100" height="100">
                                    <label for="avatar" style="border: 1px dashed black;margin:0 10px;padding:0 5px">Chọn Ảnh</label>
                                    <input accept="image/gif, image/jpeg, image/png" onchange="readURL(this,'avatarImg')" style="display:none" type="file" id="avatar" name="avatar">
                                </td>
                            </tr>
                            <tr>
                                <td>Ảnh bìa</td>
                                <td>
                                    <img id="coverImg" src="{{url($seller->getCover() ?? '')}}" alt="" width="100" height="100">
                                    <label for="cover" style="border: 1px dashed black;margin:0 10px;padding:0 5px">Chọn Ảnh</label>
                                    <input accept="image/gif, image/jpeg, image/png" onchange="readURL(this,'coverImg')" style="display:none" type="file" id="cover" name="cover">
                                </td>
                            </tr>
                            </table>
                            <tr>
                                <td><button class="cancelcat" onclick="window.location.href = '{{url()->route('superSeller')}}';return false">Hủy</button></td>
                            <td><button class="addcat">Cập Nhật</button></td>
                            </tr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../../assets/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script>
        
        function readURL(input,id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('#'+id).setAttribute('src',e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
CKEDITOR.replace('destext',{
		toolbar :
		[
			{ name: 'document', items : [ 'NewPage','Preview' ] },
            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
            { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
            { name: 'styles', items : [ 'Styles','Format' ] },
            { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		]
	});
    </script>
</body>

</html>