<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../../assetsAdmin/css/index.css">
    <link rel="stylesheet" href="../../../assetsAdmin/css/cat.css">
    <link rel="stylesheet" href="../../../assetsAdmin/css/order.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../../assetsAdmin/css/chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Discounts</title>
    <script src="../../../../assets/js/axios.js"></script>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right">
        @include('includes.top')
            <div class="bottom">
                <div class="headtitle">
                    <p style="max-width:200px;">KHUYẾN MÃI</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="{{url()->route('superDiscount')}}">Khuyến Mãi</a></span></li>

                        </ul>
                    </div>

                </div>
                <div class="tongquan tabcat">
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$discounts->count()}}
                            </p>
                            <p class="dest">
                                Tổng Khuyến Mãi
                            </p>
                        </div>
                    </div>
                    @php
                        $obj = new App\Discount;  
                    @endphp
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$avaiCount=$obj->getAvailableCount()}}
                            </p>
                            <p class="dest">
                                Đang Áp Dụng
                            </p>
                        </div>
                    </div>
                   
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$discounts->count()-$avaiCount}}
                            </p>
                            <p class="dest">
                                Đã Kết Thúc
                            </p>
                        </div>
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$flashcount = $obj->getFlashSaleCount()}}
                            </p>
                            <p class="dest">
                                FlashSale
                            </p>
                        </div>
                        
                    </div>

                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$discounts->count()-$flashcount}}
                            </p>
                            <p class="dest">
                                Khuyến Mãi Thường
                            </p>
                        </div>
                        
                    </div>
                    <div class="totalitem">
                        <div class="centeritemt">
                            <p class="numt">
                                {{$obj->getBeDiscountCount()}}
                            </p>
                            <p class="dest">
                                Sản phẩm
                            </p>
                        </div>
                    </div>
                </div>
                <div class="catlist">
                    <div class="cattitle">
                        <span><i class="fas fa-list-ul"></i> Tất Cả Đơn Hàng</span>
                        <ul class="catright">
                            <li><i class="fas fa-filter"></i> Tất Cả <i class="fas fa-angle-down"></i>
                                <ul style="width:auto;">
                                    <li onclick="filter(0)">Tất Cả </li>
                                    <li onclick="filter(1)">Loại: FlashSale</li>
                                    <li onclick="filter(2)">Loại: Khuyến Mãi </li>
                                    <li onclick="filter(3)">Trạng thái: Đang Khuyến Mãi</li>
                                    <li onclick="filter(4)">Trạng thái: Đã Kết Thúc</li>
                                    @foreach ($categories as $category)
                                    <li onclick="filter({{$category->id}},1)">Danh Mục: {{$category->name}}</li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><i class="fas fa-sort-amount-up"></i> Sắp Xếp <i class="fas fa-angle-down"></i>
                                <ul>
                                    <li onclick="orderBy(0)">Mặc định</li>
                                    <li onclick="orderBy(1)"><i class="fas fa-sort-amount-up"></i> Phần Trăm</li>
                                    <li onclick="orderBy(2)"><i class="fas fa-sort-amount-down"></i> Phần Trăm</li>
                                    <li onclick="orderBy(3)"><i class="far fa-clock"></i> Ngày Kết Thúc</li>
                                </ul>
                            </li>
                            <li><i class="fas fa-radiation"></i> Thao Tác <i class="fas fa-angle-down"></i>
                                <ul>
                                    <li><a href="{{url()->route('superAddDiscount')}}" style="color:#555"><i class="fas fa-plus-circle"></i>
                                            Thêm mới</a></li>
                                    <li onclick="deleteSelected()"><i class="far fa-trash-alt"></i> Xóa</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="tabcat taborder" id="listbox">
                        <table border="1">
                            <div>
                                <th></th>
                                <th>Sản Phẩm</th>
                                <th>Loại khuyến mãi</th>
                                <th>Phần trăm</th>
                                <th>Giá gốc</th>
                                <th>Giá sau khuyến mãi</th>
                                <th>Bắt đầu từ</th>
                                <th>Hết Hạn</th>
                                <th>Tổng</th>
                                <th>Đã Bán</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </div>
                          @foreach ($discounts as $discount)
                        <tr data-id={{$discount->id}} data-percent={{$discount->percent}} data-time={{strtotime($discount->to)}} data-cat="{{$discount->RlProduct->idcat}}" data-type="@if($discount->selled && $discount->total){{1}}@else{{2}}@endif" data-percent="{{$discount->percent}}" data-status="@if(time()-strtotime($discount->from)>0 && strtotime($discount->to)-time()>0 && (intval($discount->total) - intval($discount->selled) > 0 || ($discount->total ===null & $discount->selled===null))){{1}}@else{{0}}@endif">
                            <td><input data-idcat="{{$discount->id}}" type="checkbox" id="check"></td>
                            <td>@if($discount->RlProduct) <a href="{{url()->route('superGetProduct',['id'=>$discount->RlProduct->id])}}">{{$discount->RlProduct->name}}</a> @endif</td>
                            <td>@if($discount->selled!==null && $discount->total!==null) Flashsale @else Giảm giá @endif</td>
                            <td style="color:green;font-size:1.1em!important">-{{$discount->percent}}%</td>
                            <td>{{number_format($discount->RlProduct->price)}} VND</td>
                            <td>{{number_format(ceil($discount->RlProduct->price - $discount->RlProduct->price*$discount->percent/100))}} VND</td>
                            <td>{{date('H:i:s d/m/Y',strtotime($discount->from))}}</td>
                            <td>{{date('H:i:s d/m/Y',strtotime($discount->to))}}</td>
                            <td>{{$discount->total ?? '--'}}</td>
                            <td>{{$discount->selled ?? '--'}}</td>
                            <td>{{date('H:i:s d/m/Y',strtotime($discount->from))}}</td>
                            <td>
                                <div class="lasttd">
                                    <a href="{{url()->route('superEditDiscount',['id'=>$discount->id])}}" ><button><i class="far fa-eye"></i></button></a>
                                    <li id="showoption"><i class="fas fa-angle-down"></i>
                                        <ul>
                                            <li onclick="postDelete({{$discount->id}})"><i class="far fa-trash-alt"></i> Xóa</li>
                                            <li><a href="{{url()->route('superEditDiscount',['id'=>$discount->id])}}" style="color:#555"><i
                                                        class="far fa-edit"></i> Cập Nhật</a></li>
                                        </ul>
                                    </li>
                                </div>
                            </td>
                        </tr>   
                            @endforeach
                            
                        </table>
                        <div class="paginationx">
                            {{$discounts->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="../../../../assets/js/jquery.min.js"></script>
    <script src="../../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../../assetsAdmin/js/cat.js"></script>
    <script>
        
        function deleteSelected(){
            if(selectedCat.length ==0) return;
            if(confirm('Bạn có chắc muốn xoá '+selectedCat.length+' khuyến mãi này') ){
                axios.post('{{url()->route('superDeleteEditDiscount')}}',{
                    ids:selectedCat
                }).then(d=>{
                    window.location.reload()
                })  
            }   
        }
        function postDelete(id){
            if(confirm('Bạn có chắc muốn xoá khuyến mãi này') ){
                axios.post('{{url()->route('superDeleteEditDiscount')}}',{
                    ids:[id]
                }).then(d=>{
                    window.location.reload()
                })  
            }   
        }
        function filter(type,target=0){
            var trs = document.querySelectorAll('table tr')
            trs = Array.from(trs)
            trs.splice(0,1)
            if(target==0){
                if(type==0){
                    trs.forEach(v=>v.style.display = 'table-row')
                }else if(type==1){
                    trs.forEach(v=>{
                        if(v.dataset.type==1) v.style.display = 'table-row'
                        else v.style.display = 'none'
                    })
                }else if(type==2){
                    trs.forEach(v=>{
                        if(v.dataset.type==2) v.style.display = 'table-row'
                        else v.style.display = 'none'
                    })
                }else if(type==3){
                    trs.forEach(v=>{
                        if(v.dataset.status==1) v.style.display = 'table-row'
                        else v.style.display = 'none'
                    })
                }else if(type==4){
                    trs.forEach(v=>{
                        if(v.dataset.status==0) v.style.display = 'table-row'
                        else v.style.display = 'none'
                    })
                }
            }else if(target==1){
                trs.forEach(v=>{
                    if(v.dataset.cat==type) v.style.display = 'table-row'
                    else v.style.display = 'none'
                })
            }
        }
        function orderBy(type){
            var trs = document.querySelectorAll('#listbox table tr')
            var table = document.querySelector('#listbox table tbody')
            trs = Array.from(trs)
            html = trs[0].outerHTML
            trs.splice(0,1)
            
            if(type==0){
                trs = trs.sort((a,b)=>a.dataset.id - b.dataset.id)
            }
            if(type==1){
                trs = trs.sort((a,b)=>a.dataset.percent - b.dataset.percent)
            }
            if(type==2){
                trs = trs.sort((a,b)=>b.dataset.percent - a.dataset.percent)
            }
            if(type==3){
                trs = trs.sort((a,b)=>a.dataset.time - b.dataset.time)
            }
            trs.forEach(v=>{
                html +=v.outerHTML
            })
            table.innerHTML = html
        }
    </script>
</body>

</html>