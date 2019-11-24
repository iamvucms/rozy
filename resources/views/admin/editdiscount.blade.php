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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Discount::Update</title>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right">
            @include('includes.top')
            <div class="bottom">
                <div class="headtitle">
                    <p style="font-size:1.5em">KHUYẾN MÃI</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                        <li><span class="main"><a href="{{url()->route('superDiscount')}}">Khuyến Mãi</a></span></li>

                        </ul>
                    </div>

                </div>
                <div class="catlist" id="add">
                    <p class="cattitle">
                        <i class="fas fa-pen-nib"> </i> Cập Nhật Discount
                    </p>
                    <div class="tabcat">
                        <form action="{{url()->route('superPostEditDiscount',['id'=>$discount->id])}}" method="POST">
                            @csrf
                            <table>
                            <tr>
                                <td>Loại Khuyến Mãi</td>
                                <td><select name="type" id="dcType" onchange="changeMe()">
                                    <option value="1" @if($discount->total!==null && $discount->selled!==null) selected=selected @endif>FlashSale</option>
                                    <option value="2" @if($discount->total===null && $discount->selled===null) selected=selected @endif>Khuyến Mãi Thường</option>
                                </select></td>
                            </tr>
                            <tr @if($discount->total===null && $discount->selled===null) style="display:none" @endif id="totalInp">
                                <td>Giới Hạn Lượt Mua</td>
                                <td><input id="total" value="{{$discount->total}}" @if(isset($errors->toArray()['count']))style="border:1px solid red" @endif  min="1" @if($discount->total!==null && $discount->selled!==null) name="total" required @endif type="number" placeholder="Số Lần Sử dụng" ></td>
                            </tr>
                            <script>
                                function changeMe(){
                                    selected = document.querySelector('#dcType').value
                                    if(selected==1){
                                        document.querySelector('#totalInp').style.display ='table-row'
                                        document.querySelector('#total').removeAttribute('disabled')
                                        document.querySelector('#total').setAttribute('required',true)
                                        document.querySelector('#total').setAttribute('name','total')
                                    }else if(selected==2){
                                        document.querySelector('#total').removeAttribute('name')
                                        document.querySelector('#total').removeAttribute('required')
                                        document.querySelector('#totalInp').style.display ='none'
                                        document.querySelector('#total').setAttribute('disabled',true)
                                    }
                                }
                            </script>
                            <tr>
                                <td>Phần Trăm (<span id="myPercent">{{$discount->percent}}</span>%)</td>
                                <td><input name="percent" onchange="document.querySelector('#myPercent').innerHTML=this.value" value="{{$discount->percent}}" @if(isset($errors->toArray()['value']))style="border:1px solid red" @endif name="percent" step="1" min="1" max="100" required type="range" placeholder="Giá trị" ></td>
                            </tr>
                            <tr>
                                <td>Ngày Bắt Đầu</td>
                                <td><input value="{{date('Y-m-d\TH:i:s',strtotime($discount->from))}}" @if(isset($errors->toArray()['expired']))style="border:1px solid red" @endif min="{{date('Y-m-d')}}" required name="from" type="datetime-local" placeholder="mm/dd/YYYY"></td>
                            </tr>
                            <tr>
                                <td>Ngày Hết Hạn</td>
                            <td><input  value="{{date('Y-m-d\TH:i:s',strtotime($discount->to))}}" @if(isset($errors->toArray()['expired']))style="border:1px solid red" @endif min="{{date('Y-m-d')}}" required name="to" type="datetime-local" placeholder="mm/dd/YYYY"></td>
                            </tr>
                            <tr>
                                <td>Áp dụng cho</td>
                                <td>
                                <select class="js-example-basic-single" name="idproduct">
                                    @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                </td>
                            </tr>
                        </table> 
                        <tr>
                        <td><button class="cancelcat" onclick=" window.location.href='{{url()->route('superDiscount')}}';return false">Hủy</button></td>
                            <td><button class="addcat">Cập Nhật</button></td>
                        </tr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="../../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../../assetsAdmin/js/cat.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</body>

</html>