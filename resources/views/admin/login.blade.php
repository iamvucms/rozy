<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assetsAdmin/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Admin::Login</title>
</head>

<body>
    <div class="loginbox">
        <h2 class="logtitle">
            Đăng nhập hệ thống
        </h2>
        <form action="{{url()->route('superPostLogin')}}" id="logform" method=POST>
            @csrf
            <input type="text" name="email" placeholder="Email">
            <input name="password" type="password" placeholder="Mật Khẩu">
            <button type="submit">Đăng Nhập</button>
        </form>
    </div>
</body>

</html>