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
</head>

<body>
    <div class="vucms">
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
    </script>
</body>

</html>