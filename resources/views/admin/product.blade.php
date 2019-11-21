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
    <script src="../../assets/js/axios.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Products</title>
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
            if(confirm('Bạn có chắc muốn xoá sản phẩm này') ){
                axios.post('{{url()->route('superDeleteEditProduct')}}',{
                    ids:selectedCat
                }).then(d=>{
                    data = d.data
                    window.location.reload()
                })  
            }   
        }
    </script>
</body>

</html>