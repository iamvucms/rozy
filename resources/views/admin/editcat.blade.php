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
    <title>Admin::Categories::Edit</title>
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

                </div>
                <div class="catlist" id="add">
                    <p class="cattitle">
                        <i class="fas fa-pen-nib"> </i> Thêm Danh Mục
                    </p>
                    <div class="tabcat">
                        
                    <form enctype="multipart/form-data" action="{{url()->route('superPostEditCategory',['slug'=>$cat->slug])}}" method=POST>
                        @csrf
                        <table>
                            <tr>
                                <td>Tên danh mục</td>
                                <td><input @if (@$errors->toArray()['name'])
                                    style="border:1px solid red"
                                    @endif name="name" type="text" value="{{$cat->name}}"></td>
                            </tr>
                            <tr>
                                <td>Ảnh Danh Mục</td>
                                <td><img id="curImg" style="height:80px;width:80px;padding:5px" src="{{url($cat->img)}}" alt="">
                                    <label for="img" style="border:1px solid #ddd;padding:5px;cursor:pointer;height:40px;line-height:30px;margin-bottom:0px;">Chọn ảnh</label>
                                    <input accept="image/gif, image/jpeg, image/png"  onchange="readURL(this)" style="display:none" name="img" id="img" type="file" value="{{$cat->name}}">
                                </td>
                            </tr>
                            
                            <script>
                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            document.querySelector('#curImg').setAttribute('src',e.target.result)
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            </script>
                            <tr>
                                <td>Icon Danh Mục(Fontawesome)</td>
                                <td><input @if (@$errors->toArray()['icon'])
                                    style="border:1px solid red"
                                    @endif name="icon" type="text" value="{{$cat->icon}}"></td>
                            </tr>
                            <tr>
                                <td>Mô tả danh mục </td>
                                <td><input name="description" type="text" value="{{$cat->description}}"></td>
                            </tr>
                            <tr>
                                <td>SEO Từ khóa</td>
                                <td><input name="seo_keys" type="text" value="{{$cat->seo_keys}}"></td>
                            </tr>
                            <tr>
                                <td>SEO Mô tả</td>
                                <td><textarea name="seo_description" id=""
                                style="width:100%">{{$cat->seo_description}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Thứ tự</td>
                                <td><input @if (@$errors->toArray()['order'])
                                    style="border:1px solid red"
                                    @endif name="order" type="number" value="{{$cat->order}}"></td>
                            </tr>
                            <tr>
                                <td>SEO URL</td>
                                <td><input @if (@$errors->toArray()['slug'])
                                    style="border:1px solid red"
                                    @endif name="slug" type="text" value="{{$cat->slug}}"></td>
                            </tr>
                            <tr>
                            <td><button onclick="window.location.href='{{url()->route('superCategory')}}';return false;" class="cancelcat">Hủy</button></td>
                                <td><button class="addcat">Lưu Lại</button></td>
                            </tr>
                        </table>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assetsAdmin/js/chart.min.js"></script>
    <script src="../../assetsAdmin/js/cat.js"></script>
    <script>
    </script>
</body>

</html>