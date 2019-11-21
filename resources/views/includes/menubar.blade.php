<div class="menubar">
            <div class="menuname">
                <span class="namehiden">
                    ADMIN-VUCMS
                </span><button id="propbar"><i class="fas fa-bars"></i></button>
            </div>
            <div class="options">
                <div class="top">
                    <div class="me">
                        <img src="{{url($user->getAvatar() ??'https://png.pngtree.com/svg/20160601/unknown_avatar_182562.png') }}"
                            alt="">
                        <div class="meme">
                            <p class="online"><span class="pointonline"></span>
                                Online</p>
                            <p class="myname">{{$user->getInfo()->name}}</p>
                        </div>
                    </div>
                    <div class="searchbox">
                        <form action="#">
                            <input type="search" placeholder="Tìm Kiếm">
                        </form>
                    </div>
                </div>
                <div class="navigation">
                    <div class="navtitle">
                        Khu vực chính
                    </div>
                    <div class="navitems">
                        <ul class="items">
                            <li class="lv1"><a href="{{url()->route('dashboard')}}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span class="navtext">Bảng điều
                                        khiển</span>
                                </a>
                            </li>
                            <li class="lv1"><i class="fas fa-chart-bar"></i>
                                <span class="navtext">Quản lí</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="{{url()->route('superCategory')}}">Danh mục</a></li>
                                    <li class="lv2"><a href="{{url()->route('superProduct')}}">Sản phẩm</a></li>
                                    <li class="lv2"><a href="{{url()->route('superReview')}}">Đánh giá</a></li>
                                   @if($user->role_id==1)  <li class="lv2"><a href="{{url()->route('superSeller')}}">Nhà cung cấp</a></li> @endif
                                </ul>
                            </li>

                            <!-- <li class="lv1"><i class="fas fa-layer-group"></i>
                                                                                <span class="navtext">Gian hàng</span><i
                                                                                          class="fas fa-angle-right"></i>
                                                                                          <ul class="lv2items">
                                                                                                    <li class="lv2">Bố cục</li>
                                                                                                    <li class="lv2">Banner</li>
                                                                                                    <li class="lv2">Công cụ SEO</li>
                                                                                                    <li class="lv2">Subcategory 4</li>
                                                                                                    <li class="lv2">Subcategory 5</li>
                                                                                          </ul>
                                                                      </li> -->
                            <li class="lv1"><i class="fas fa-users"></i> <span class="navtext">Khách hàng</span><i
                                    class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="{{url()->route('superCustomer')}}">Danh sách</a></li>
                                    <li class="lv2"><a href="{{url()->route('superBannerCustomer')}}">Danh sách bị cấm</a></li>
                                </ul>
                            </li>
                            <li class="lv1"><i class="fas fa-shopping-cart"></i>
                                <span class="navtext">Bán hàng</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="{{url()->route('superOrder')}}">Đơn hàng</a></li>
                                    <li class="lv2"><a href="coupon.html">Coupon</a></li>
                                </ul>
                            </li>
                            <li class="lv1"><i class="fas fa-desktop"></i>
                                <span class="navtext">Thiết Kế</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2"><a href="layout.html">Bố cục</a></li>
                                    <li class="lv2"><a href="banner.html">Banner</a></li>
                                    <li class="lv2"><a href="seotool.html">Công cụ SEO</a></li>
                                </ul>
                            </li>
                            <li class="lv1"><i class="fas fa-list-ul"></i>
                                <span class="navtext">Tiện ích</span><i class="fas fa-angle-right"></i>
                                <ul class="lv2items">
                                    <li class="lv2">Biên soạn</li>
                                    <li class="lv2">Subcategory 2</li>
                                    <li class="lv2">Subcategory 3</li>
                                    <li class="lv2">Subcategory 4</li>
                                    <li class="lv2">Subcategory 5</li>
                                </ul>
                            </li>
                            <li class="lv1"><a href="setting.html"><i class="fas fa-cogs"></i> <span class="navtext">Cài
                                        đặt
                                        chung</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>