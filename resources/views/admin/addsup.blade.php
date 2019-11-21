<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../../assetsAdmin/css/cat.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Suppliers::Add</title>
    <script src="../../../../assetsAdmin/ckeditor/ckeditor.js"></script>
    <script src="../../../../assets/js/axios.js"></script>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right">
        @include('includes.top')
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
                        <form enctype="multipart/form-data" action="{{url()->route('superPostAddSeller')}}" method="POST">
                            @csrf
                        <table>
                            <tr>
                                <td>Tên Gian Hàng</td>
                                <td><input required name="name"  type="text" placeholder="Tên Gian Hàng"></td>
                            </tr>
                            <tr>
                                <td>Email hiển thị</td>
                                <td><input required name="displayEmail" type="text"  placeholder="Email hiển thị"></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại hiển thị</td>
                                <td><input required name="displayPhone" type="text"  placeholder="Số điện thoại hiển thị"></td>
                            </tr>
                            <tr>
                                <td>Thành phố</td>
                                <td>
                                    <select required name="city" id="city" onchange="getDistrict()">
                                        @foreach ($city as $c)
                                        <option value="{{$c->id}}">{{$c['name']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Quận/Huyện</td>
                                <td>
                                    <select required onchange="getCommune()" name="district" id="district" disabled>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Phường/Thị xã</td>
                                <td>
                                    <select required name="commune" id="commune" disabled>
                                       
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Đường</td>
                                <td>
                                <input required type="text" name="street" id="street" disabled>
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
                                <td>Email Đăng Nhập</td>
                                <td><input required placeholder="Email Đăng Nhập" type="text" name="email" required></td>
                            </tr>
                            <tr>
                                <td>Mật khẩu</td>
                                <td><input required placeholder="Mật Khẩu" type="password" name="password" required></td>
                            </tr>

                            <tr>
                                <td>Mô tả ngắn</td>
                                <td><input required name="short_description" placeholder="Mô tả ngắn" type="text" name="short_description" required></td>
                            </tr>
                            <tr>
                                <td>Mô tả Nhà Cung Cấp</td>
                                <td><textarea required name="description" id="destext" style="width:100%"
                                        placeholder="Mô tả Nhà Cung Cấp">
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Ảnh đại diện</td>
                                <td>
                                    <img id="avatarImg" style="display:none" alt="" width="100" height="100">
                                    <label for="avatar" style="border: 1px dashed black;margin:0 10px;padding:0 5px">Chọn Ảnh</label>
                                    <input required accept="image/gif, image/jpeg, image/png" onchange="readURL(this,'avatarImg')" style="display:none" type="file" id="avatar" name="avatar">
                                </td>
                            </tr>
                            <tr>
                                <td>Ảnh bìa</td>
                                <td>
                                    <img id="coverImg" style="display:none" alt="" width="100" height="100">
                                    <label for="cover" style="border: 1px dashed black;margin:0 10px;padding:0 5px">Chọn Ảnh</label>
                                    <input required accept="image/gif, image/jpeg, image/png" onchange="readURL(this,'coverImg')" style="display:none" type="file" id="cover" name="cover">
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
    <script src="../../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../../assetsAdmin/js/cat.js"></script>
    <script>
        
        function readURL(input,id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('#'+id).style.display = 'inline-block'
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