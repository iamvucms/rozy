<div class="top">
    <ul class="listtop">
        <li><i class="far fa-bell"></i> <span class="toptext">Thông báo</span>
        </li>
        <li><i class="far fa-envelope"></i> <span class="toptext">Tin
                nhắn</span></li>
        <li class="topprofile">
            <img src="{{url($user->getAvatar() ?? '')}}" alt="">
            <span class="nameprofile"><span class="toptext">{{$user->getInfo()->name}}</span>
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
                <li><i class="fas fa-sign-out-alt"></i> <a href="{{url()->route('superLogout')}}">&nbsp;
                        Đăng xuất</a>
                </li>
            </ul>
        </li>
    </ul>
</div>