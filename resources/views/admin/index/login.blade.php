<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
	<meta charset="UTF-8">
	<title>后台登录</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('/css/font.css')}}">
	<link rel="stylesheet" href="{{asset('/css/xadmin.css')}}">
    <script type="text/javascript" src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/lib/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('/js/xadmin.js')}}"></script>

</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div style="text-align:center;color: red;font-size: 23px;" id="msg"></div>
        <div class="message">管理登录</div>
        <div id="darkbannerwrap"></div>
        <form  class="layui-form"  >
           {{csrf_field()}}
            <input name="username" placeholder="用户名"  type="text"  class="layui-input" >
            <hr class="hr15">
            <input name="password" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            {{--<input type="text" lay-verify="required" name="captcha" class="layui-input" style="vertical-align: middle">
            <img src="{{captcha_src('default')}}" alt="">
            <hr class="hr15">
            --}}
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="button" id="sub-btn">
            <hr class="hr20" >
        </form>
    </div>
</body>
<script type="text/javascript">
    $(function () {
        $('#sub-btn').click(function () {
            $.post("{{url('admin/dologin')}}",$('form').serialize(),function(data){
                if (data.status==1){
                    layer.msg(data.message,{time:1000},function () {
                        location.href="{{url('/admin/')}}";
                    });
                }else {
                    $('#msg').css({"display":'block'});
                    if (data.message.username){
                        $('#msg').html(data.message.username);
                    }else if (data.message.password) {
                        $('#msg').html(data.message.password);
                    }else {
                        $('#msg').html(data.message);
                    }

                }
            },"json");
        })
        })
</script>
</html>