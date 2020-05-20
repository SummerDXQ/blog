<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('admin/css/font.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('admin/js/xadmin.js')}}"></script>

</head>
<body class="login-bg">

    <div class="login layui-anim layui-anim-up">
        <div class="message">Blog Management System</div>
        <!-- Error Message -->
        @if ( is_object($errors))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            {{Session::get('errors')}}
        @endif
        <div id="darkbannerwrap"></div>
        <form method="post" class="layui-form" action="http://localhost:8080/blog/blog/public/admin/doLogin">
            @csrf
            <input name="username" placeholder="username"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="password"  type="password" class="layui-input">
            <hr class="hr15">
            <input name="captcha" lay-verify="required" placeholder="captcha"  type="text" class="layui-input" style="width:50%;float:left;">
            <div style="height:50px;padding:5px;float:right;">
                <img src="http://localhost:8080/blog/blog/public/admin/captcha" alt="captcha" id="codeimg" >
            </div>
            <input value="Login" lay-submit lay-filter="login" style="width:100%;margin-top:15px;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            // layui.use('form', function(){
            //   var form = layui.form;
            //   // layer.msg('玩命卖萌中', function(){
            //   //   //关闭后的操作
            //   //   });
            //   //监听提交
            //   form.on('submit(login)', function(data){
            //     // alert(888)
            //     layer.msg(JSON.stringify(data.field),function(){
            //         location.href='index.html'
            //     });
            //     return false;
            //   });
            // });

            $('#codeimg').click(function(){
                this.src='http://localhost:8080/blog/blog/public/admin/captcha?code='+Math.random();
            })
        })


    </script>


    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>
