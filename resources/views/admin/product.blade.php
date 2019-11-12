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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Admin::Products</title>
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
                    <p>SẢN PHẨM</p>
                    <div class="breadcrumb">
                        <ul>
                            <li><span class="sub">Quản lí</span></li>
                            <li><span class="aright"><i class="fas fa-angle-right"></i></span></li>
                            <li><span class="main"><a href="">Sản Phẩm</a></span></li>

                        </ul>
                    </div>
                    <div class="groupbtn">
                        <a href="addproduct.html" class="add"><button id="add">+</button></a>
                        <a href="" class="f5"><button id="f5"><i class="fas fa-sync"></i></button></a>
                        <a href="javascript:void(0)" class="remove"><button id="remove"><i
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
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/product1.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">baseball pain discovery mouth area stretch
                                        discuss people trade stick nine rod differ typical phrase announced beginning
                                        these prevent when must avoid remain seeing</a></td>
                                <td>sunlight</td>
                                <td>8,000,000 VND</td>
                                <td>
                                    <p><span>85</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/dodadung.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">daughter pink spring declared independent
                                        slow taste press heat flower immediately along move electricity somebody sets
                                        treated climb fought universe deep atmosphere pan community</a></td>
                                <td>write</td>
                                <td>13,000,000 VND</td>
                                <td>
                                    <p><span>88</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="stopsell">Ngừng Kinh doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/mega4.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">daily able former which cowboy
                                        understanding garden uncle minute gave begun colony unit traffic even longer
                                        exactly write story orange told map baby garage</a></td>
                                <td>independent</td>
                                <td>15,000,000 VND</td>
                                <td>
                                    <p class="war"><span>8</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/mega3.jpg" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">wool pan road back faster settle stems
                                        that bear frequently trail pine game shoe business test pain belt safe identity
                                        tune journey market mission</a></td>
                                <td>split</td>
                                <td>13,000,000 VND</td>
                                <td>
                                    <p><span>39</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="stopsell">Ngừng Kinh doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/dodadung.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">brother meat bowl tonight dawn game throat
                                        form offer certainly make garden warn figure gently kind sad air account regular
                                        orange flag hit ride</a></td>
                                <td>addition</td>
                                <td>8,000,000 VND</td>
                                <td>
                                    <p class="dan"><span>0</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="hethang">Hết Hàng</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/product4.jpg" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">chamber structure moving screen its
                                        ancient unless later sell happy author forty occur action become design band
                                        musical represent lady pack full whispered instant</a></td>
                                <td>additional</td>
                                <td>15,000,000 VND</td>
                                <td>
                                    <p><span>17</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/mega7.jpg" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">underline none discover sun see various
                                        truth struggle mind science heat football him corner went silly small learn
                                        breeze impossible political sharp handle world</a></td>
                                <td>weigh</td>
                                <td>13,000,000 VND</td>
                                <td>
                                    <p><span>81</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="hethang">Hết Hàng</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/dodadung.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">prove importance business deer wonder seed
                                        poetry composition growth brain substance some duck show citizen sentence grew
                                        solid golden trail position help struggle knife</a></td>
                                <td>drink</td>
                                <td>7,000,000 VND</td>
                                <td>
                                    <p class="war"><span>9</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/product2.jpg" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">farm studying aboard brass written
                                        population diameter blew buried worried around machinery cannot law rubbed hung
                                        section thy hat went motion fur everywhere disease</a></td>
                                <td>knowledge</td>
                                <td>2,000,000 VND</td>
                                <td>
                                    <p><span>21</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/denwa.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">empty doctor garage earn quickly tax part
                                        those impossible electricity solar cost soon suddenly ago whenever giving eight
                                        recognize wait system rear kind specific</a></td>
                                <td>learn</td>
                                <td>5,000,000 VND</td>
                                <td>
                                    <p><span>18</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="hethang">Hết Hàng</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/mega14.jpg" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">parts metal coffee refused adult nodded
                                        been layers hair night round property product many yourself fed month weak coast
                                        matter stand total area library</a></td>
                                <td>truth</td>
                                <td>11,000,000 VND</td>
                                <td>
                                    <p><span>51</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/product2.jpg" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">save barn wish prevent perfectly slowly
                                        seven statement strip finest cloth cup my ruler compare sing equator image
                                        practical such lake cloud eye everybody</a></td>
                                <td>key</td>
                                <td>4,000,000 VND</td>
                                <td>
                                    <p><span>52</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/mega12.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">natural therefore five golden sides upon
                                        fur service establish next ever gone sight jump parent center seldom receive
                                        bread open orbit chosen knife troops</a></td>
                                <td>similar</td>
                                <td>10,000,000 VND</td>
                                <td>
                                    <p><span>35</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/mega10.jpg" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">escape wash stove exciting imagine cry
                                        usual lucky pink cat people skill seen behavior vegetable eight rule horn
                                        handsome negative task piano laugh far</a></td>
                                <td>near</td>
                                <td>3,000,000 VND</td>
                                <td>
                                    <p><span>94</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/dodadung.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">bottom modern dark said warn location
                                        recent faster base he satellites describe arrow article lonely excellent
                                        changing stuck camera route bean steel doll difficulty</a></td>
                                <td>actual</td>
                                <td>8,000,000 VND</td>
                                <td>
                                    <p class="war"><span>3</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/mega4.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">coast ago at finger arrange behind
                                        tomorrow declared pocket stronger mouse amount train pilot green tax compare we
                                        listen struggle column said ourselves repeat</a></td>
                                <td>loss</td>
                                <td>11,000,000 VND</td>
                                <td>
                                    <p class="war"><span>0</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check"></td>
                                <td>
                                    <p><img src="../../../assetsAdmin/img/dodadung.png" alt=""></p>
                                </td>
                                <td><a href="../detail.html" target="__blank">with acres top drawn hardly everything
                                        quietly ground steel beside done organized coast evening speak wild film refused
                                        return too drew statement nodded tape</a></td>
                                <td>locate</td>
                                <td>10,000,000 VND</td>
                                <td>
                                    <p class="war"><span>9</span></p>
                                </td>
                                <td>
                                    <p class="sellstt" id="selling">Đang Kinh Doanh</p>
                                </td>
                                <td><a href="editproduct.html"><button><i class="far fa-edit"></i></button></a></td>
                            </tr>
                        </table>
                        <div class="pagination">
                            <ul>
                                <li class="active"><a href="javascript:void(0)">1</a></li>
                                <li><a href="javascript:void(0)">2</a></li>
                                <li><a href="javascript:void(0)">3</a></li>
                                <li><a href="javascript:void(0)"><i class="fas fa-angle-right"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fas fa-step-forward"></i></a></li>
                            </ul>
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