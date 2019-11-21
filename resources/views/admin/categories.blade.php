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
    <script src="../../assets/js/axios.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Categories</title>
</head>

<body>
    <div class="vucms">
        @include('includes.menubar')
        <div class="right">
            @include('includes.top')
            <div class="bottom">
                <div class="headtitle">
                    <p>DANH MỤC</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Danh Mục</a></span></li>

                        </ul>
                    </div>
                    <div class="groupbtn">
                        <a href="{{url()->route('superAddCategory')}}" class="add"><button id="add">+</button></a>
                        <a href="" class="f5"><button id="f5"><i class="fas fa-sync"></i></button></a>
                        <a href="javascript:void(0)" onclick="deleteSelected()" class="remove"><button id="remove"><i
                                    class="far fa-trash-alt"></i></button></a>
                    </div>
                </div>
                <div class="catlist">
                    <p class="cattitle">
                        <i class="fas fa-list-ul"></i> Danh Mục Sản Phẩm
                    </p>
                    <div class="tabcat" id="listbox">
                        <table border="1">
                            <tr>
                                <th></th>
                                <th>Ảnh Danh Mục</th>
                                <th>Tên Danh Mục</th>
                                <th>Thứ tự</th>
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($categories as $cat)
                            <tr>
                            <td><input data-idcat="{{$cat->id}}" type="checkbox" id="checkCat"></td>
                                <td><img src="{{url($cat->img)}}" alt="" style="height:70px;width:70px;border:1px solid #ddd;padding:5px;margin:5px"></td>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->order}}</td>
                                <td><a href="{{url()->route('superEditCategory',['slug'=>$cat->slug])}}"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script>
        function deleteSelected(){
            if(selectedCat.length ==0) return;
            if(confirm('Bạn có chắc muốn xoá danh mục này') ){
                axios.post('{{url()->route('superDeleteEditCategory')}}',{
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