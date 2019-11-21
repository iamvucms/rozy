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
	<title>Admin::Products::Update</title>
</head>

<body>
	<div class="vucms">
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
							<li><span class="main"><a href="{{url()->route('superProduct')}}">Sản Phẩm</a></span></li>

						</ul>
					</div>

				</div>
				<form enctype="multipart/form-data" action="{{url()->route('superPostEditProduct',['slug'=>$product->slug])}}" method="POST">
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
								<td><input @if (isset($errors->toArray()['name']))style="border:1px solid red"@endif value="{{$product->name}}" required name="name" type="text" placeholder="Tên sản phẩm"></td>
								</tr>

								<tr>
									<td>Thẻ meta title</td>
									<td><input @if (isset($errors->toArray()['metaTitle']))style="border:1px solid red"@endif value="{{$product->metaTitle}}" required name="metaTitle" type="text" placeholder="Thẻ meta title"></td>
								</tr>

								<tr>
									<td>Danh mục</td>
									<td>
										<select name="idcat" id="" @if (isset($errors->toArray()['idcat']))style="border:1px solid red"@endif>
											@foreach ($categories as $cat)
										    <option value="{{$cat->id}}" @if($product->idcat==$cat->id) selected=selected @endif>{{$cat->name}}</option>
											@endforeach
											
										</select>
									</td>
								</tr>
								<tr>
									<td>Giá</td>
									<td><input @if (isset($errors->toArray()['cost']))style="border:1px solid red"@endif name="cost" value="{{$product->price}}" required type="number" value="0" min="0"></td>
								</tr>
								<tr>
									<td>Trạng thái</td>
									<td>
										<select @if (isset($errors->toArray()['status']))style="border:1px solid red"@endif name="status" id="">
											<option value="1" @if($product->status==1)selected=selected @endif>Đang Kinh Doanh</option>
											<option value="2" @if($product->status==2)selected=selected @endif>Hết Hàng</option>
											<option value="3" @if($product->status==3)selected=selected @endif>Ngừng Kinh Doanh</option>
										</select>
									</td>
								</tr>
								@if ($user->role_id==1)
								<tr>
									<td>Nhà cung cấp</td>
									<td>
										<select @if (isset($errors->toArray()['status']))style="border:1px solid red"@endif name="idsell" id="">
											@foreach (App\Seller::get() as $seller)
											<option @if($seller->id==$product->idsell)selected=selected @endif value="{{$seller->id}}">{{$seller->name}}</option>
											@endforeach
										</select>
									</td>
								</tr>
								@endif
							</table>
							<table id="tab2">
								<tr>
									<td>Thẻ Meta mô tả</td>
									<td><input @if (isset($errors->toArray()['metaDescription']))style="border:1px solid red"@endif value="{{$product->metaDescription}}" required name="metaDescription" type="text" placeholder="Thẻ Meta mô tả	"></input></td>
								</tr>
								<tr>
									<td>Thẻ Meta Keyword</td>
									<td><input @if (isset($errors->toArray()['metaKeyword']))style="border:1px solid red"@endif value="{{$product->metaKeyword}}" required name="metaKeyword" type="text" placeholder="Thẻ Meta Keyword"></td>
								</tr>
								<tr>
									<td>Mô tả sản phẩm</td>
									<td><textarea @if (isset($errors->toArray()['description']))style="border:1px solid red"@endif required id="destext" name="description" style="width:100%" placeholder="Mô tả danh mục">{{$product->description}}</textarea></td>
								</tr>
							</table>
							<table id="tab3">
								<div>
									@if ($product->getProps())
										@foreach ($product->getProps() as $key=>$value)
											@if (array_search($key,['sku','thuonghieu','model','madein'])===false)
											<tr>
												<td><input value="{{$key}}" required name="propertyName[]" type="text" placeholder="Tên trường"
													style="text-align: right;padding-right: 5px;font-weight: bold;"></td>
												<td style="padding-left: 25px!important;"><input required value="{{$value}}" name="propertyValue[]" type="text" placeholder="Giá trị"></td>
												<td style="width:10%"><button id="addfield">x</button></td>
											</tr>
											@endif
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
								<td><input @if (isset($errors->toArray()['model']))style="border:1px solid red"@endif value="{{$product->getProps()['model'] ?? ''}}" required name="model"  type="text" placeholder="Model"></td>
								</tr>
								<tr>
									<td> Thương hiệu</td>
									<td><input @if (isset($errors->toArray()['brand']))style="border:1px solid red"@endif value="{{$product->getProps()['thuonghieu'] ?? ''}}" required name="brand" type="text" placeholder="Thương hiệu"></td>
								</tr>
								<tr>
									<td>SKU</td>
									<td><input @if (isset($errors->toArray()['sku']))style="border:1px solid red"@endif required value="{{$product->getProps()['sku'] ?? ''}}" name="sku" type="text" placeholder="SKU"></td>
								</tr>
								<tr>
									<td>Số Lượng</td>
									<td><input @if (isset($errors->toArray()['quantity']))style="border:1px solid red"@endif value="{{$product->quantity}}" required name="quantity" type="number" min="1" value="1" placeholder="Số Lượng"></td>
								</tr>
								<tr>
									<td>Sản xuất tại</td>
									<td><input @if (isset($errors->toArray()['madeIn']))style="border:1px solid red"@endif required value="{{$product->getProps()['madein'] ?? ''}}" name="madeIn" type="text" placeholder="Sản xuất tại"></td>
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
								
								@if($product->Avatar())
								<tr>
									<td style="position:relative"><img  src="{{url($product->Avatar()->src ?? '')}}" style="display:;" id="Img_0"></td>
									<td><select id=""><option value="1">Ảnh đại diện</option></td>
									<td><button id="delsale" data-id="{{$product->Avatar()->id}}">x</button></td>
								</tr>
								@endif
								@php
									$ix = 1;
								@endphp
								@foreach ($product->Images() as $productImg)
								
								<td style="position:relative"><img  src="{{url($productImg->src ?? '')}}" style="display:;" id="Img_{{$ix}}"></td>
									<td><select id=""><option value="2" selected>Ảnh sản phẩm</option></select></td>
									<td><button id="delsale" data-id="{{$productImg->id}}">x</button></td>
								</tr>
								@php
									$ix++;
								@endphp
								@endforeach
								@foreach ($product->SlideImages() as $productImg)
								<td style="position:relative"><img  src="{{url($productImg->src ?? '')}}" style="display:;" id="Img_{{$ix}}"></td>
									<td><select  id=""><option value="3" selected>Ảnh slider</option></select></td>
									<td><button id="delsale" data-id="{{$productImg->id}}">x</button></td>
								</tr>
								@php
									$ix++;
								@endphp
								@endforeach
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
	<script>
		var idImg = {{$ix}};</script>
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