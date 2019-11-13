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
	<script src="../../../assetsAdmin/ckeditor/ckeditor.js"></script>
	<title>Admin::Products::Add</title>
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
						<img src="../../../assetsAdmin/img/avt.jpg" alt="">
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
					<p>SẢN PHẨM</p>
					<div class="breadcrumb">
						<ul>
							<li><span class="sub">Quản lí</span></li>
							<li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
							<li><span class="main"><a href="{{url()->route('superProduct')}}">Sản Phẩm</a></span></li>

						</ul>
					</div>

				</div>
				<form enctype="multipart/form-data" action="{{url()->route('superPostAddProduct')}}" method="POST">
					@csrf
					<div class="catlist" id="add">
						<p class="cattitle">
							<i class="fas fa-pen-nib"> </i> Thêm Sản Phẩm
						</p>
						<div class="tabcat">
							<div class="panel">
								<ul>
									<li data-id="tab1" class="active">Chung</li>
									<li data-id="tab4">Thông Số Chi Tiết</li>
									<li data-id="tab3">Thông Số kĩ thuật</li>
									<li data-id="tab2">Mô tả & SEO</li>
									<li data-id="tab6">Hình ảnh</li>
								</ul>
							</div>
							<table id="tab1">

								<tr>
									<td>Tên sản phẩm</td>
								<td><input @if (isset($errors->toArray()['name']))style="border:1px solid red"@endif value="{{old('name')}}" required name="name" type="text" placeholder="Tên sản phẩm"></td>
								</tr>

								<tr>
									<td>Thẻ meta title</td>
									<td><input @if (isset($errors->toArray()['metaTitle']))style="border:1px solid red"@endif value="{{old('metaTitle')}}" required name="metaTitle" type="text" placeholder="Thẻ meta title"></td>
								</tr>

								<tr>
									<td>Danh mục</td>
									<td>
										<select name="idcat" id="" @if (isset($errors->toArray()['idcat']))style="border:1px solid red"@endif>
											@foreach ($categories as $cat)
										<option value="{{$cat->id}}">{{$cat->name}}</option>
											@endforeach
											
										</select>
									</td>
								</tr>
								<tr>
									<td>Giá</td>
									<td><input @if (isset($errors->toArray()['cost']))style="border:1px solid red"@endif name="cost" value="{{old('cost')}}" required type="number" value="0" min="0"></td>
								</tr>
								<tr>
									<td>Trạng thái</td>
									<td>
										<select @if (isset($errors->toArray()['status']))style="border:1px solid red"@endif name="status" id="">
											<option value="1">Đang Kinh Doanh</option>
											<option value="2">Hết Hàng</option>
											<option value="3">Ngừng Kinh Doanh</option>
										</select>
									</td>
								</tr>
								
							</table>
							<table id="tab2">
									
								<tr>
									<td>Thẻ Meta mô tả</td>
									<td><input @if (isset($errors->toArray()['metaDescription']))style="border:1px solid red"@endif value="{{old('metaDescription')}}" required name="metaDescription" type="text" placeholder="Thẻ Meta mô tả	"></input></td>
								</tr>
								<tr>
									<td>Thẻ Meta Keyword</td>
									<td><input @if (isset($errors->toArray()['metaKeyword']))style="border:1px solid red"@endif value="{{old('metaKeyword')}}" required name="metaKeyword" type="text" placeholder="Thẻ Meta Keyword"></td>
								</tr>
								<tr>
									<td>Mô tả sản phẩm</td>
									<td><textarea @if (isset($errors->toArray()['description']))style="border:1px solid red"@endif required id="destext" name="description" style="width:100%" placeholder="Mô tả danh mục">{{old('description')}}</textarea></td>
								</tr>
							</table>
							<table id="tab3">
								<div>
									@if (old('propertyName'))
										@foreach (old('propertyName') as $key=>$value)
										<tr>
											<td><input value="{{$value}}" required name="propertyName[]" type="text" placeholder="Tên trường"
												style="text-align: right;padding-right: 5px;font-weight: bold;"></td>
											<td style="padding-left: 25px!important;"><input required value="{{old('propertyValue')[$key]}}" name="propertyValue[]" type="text" placeholder="Giá trị"></td>
											<td style="width:10%"><button id="addfield">x</button></td>
										</tr>
										@endforeach
									@endif
									<tr>
										<td><input required name="propertyName[]" type="text" placeholder="Tên trường"
												style="text-align: right;padding-right: 5px;font-weight: bold;"></td>
										<td style="padding-left: 25px!important;"><input required name="propertyValue[]" type="text" placeholder="Giá trị"></td>
										<td style="width:10%"><button id="addfield">+</button></td>
									</tr>
							</table>

							<table id="tab4">

								<tr>
									<td>Model</td>
								<td><input @if (isset($errors->toArray()['model']))style="border:1px solid red"@endif value="{{old('model')}}" required name="model"  type="text" placeholder="Model"></td>
								</tr>
								<tr>
									<td> Thương hiệu</td>
									<td><input @if (isset($errors->toArray()['brand']))style="border:1px solid red"@endif value="{{old('brand')}}" required name="brand" type="text" placeholder="Thương hiệu"></td>
								</tr>
								<tr>
									<td>SKU</td>
									<td><input @if (isset($errors->toArray()['sku']))style="border:1px solid red"@endif required value="{{old('sku')}}" name="sku" type="text" placeholder="SKU"></td>
								</tr>
								<tr>
									<td>Số Lượng</td>
									<td><input @if (isset($errors->toArray()['quantity']))style="border:1px solid red"@endif value="{{old('quantity')}}" required name="quantity" type="number" min="1" value="1" placeholder="Số Lượng"></td>
								</tr>
								<tr>
									<td>Sản xuất tại</td>
									<td><input @if (isset($errors->toArray()['madeIn']))style="border:1px solid red"@endif required value="{{old('madeIn')}}" name="madeIn" type="text" placeholder="Sản xuất tại"></td>
								</tr>
							</table>
							{{-- <table id="tab5" border="1">
								<tr>
									<th>Nhóm khách hàng</th>
									<th>Số lượng</th>
									<th>Giá bán</th>
									<th>Ngày bắt đầu</th>
									<th>Ngày kết thúc</th>
									<th></th>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><button id="addsale">+</button></td>
								</tr>
							</table> --}}
							<table id="tab6" border="1">
								<tr>
									<th>Ảnh</th>
									<th>Nhóm Ảnh</th>
									<th></th>
								</tr>
								<tr>
									<td><label style="border:1px dashed #333;padding:0px 15px;cursor:pointer" for="imgInp_0" id="lbl_0">Chọn Ảnh</label><input required onchange="readURL(this,0)" name="ImgProducts[]" id="imgInp_0" style="display:none" type="file"><img style="display:none;" id="Img_0"></td>
									<td><select required name="groupImg[]" id=""><option value="1">Ảnh đại diện</option></td>
									<td><button id="delsale">x</button></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td><button id="addsale">+</button></td>
								</tr>
							</table>
							<tr>
							<td><button class="cancelcat" onclick="window.location.href = '{{url()->route('superProduct')}}';return false">Hủy</button></td>
								<td><button class="addcat">Thêm</button></td>
							</tr>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="../../../../assets/js/jquery.min.js"></script>
	<script src="../../../assetsAdmin/js/chart.min.js"></script>
	<script src="../../../assetsAdmin/js/cat.js"></script>
	<script>
		function readURL(input,outputId) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					document.querySelector('#lbl_'+outputId).style.display= 'none'
					document.querySelector('#Img_'+outputId).style.display= 'inline-block'
					document.querySelector('#Img_'+outputId).setAttribute('src',e.target.result)
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
		CKEDITOR.replace('destext');
	</script>
</body>

</html>