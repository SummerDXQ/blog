<div class="container">
    <div class="logo"><a href="./index.html">Blog Management System</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav left fast-add" lay-filter="">
        <li class="layui-nav-item">
        <a href="javascript:;">+Add</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a onclick="x_admin_show('资讯','http://www.baidu.com')"><i class="iconfont">&#xe6a2;</i>Info</a></dd>
            <dd><a onclick="x_admin_show('图片','http://www.baidu.com')"><i class="iconfont">&#xe6a8;</i>Images</a></dd>
            <dd><a onclick="x_admin_show('用户','http://www.baidu.com')"><i class="iconfont">&#xe6b8;</i>User</a></dd>
        </dl>
        </li>
    </ul>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
        <a href="javascript:;">admin</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">Profile</a></dd>
            <dd><a onclick="x_admin_show('切换帐号','http://www.baidu.com')">Switch Account</a></dd>
            <dd><a href="{{url('admin/logout')}}">Logout</a></dd>
        </dl>
        </li>
        <li class="layui-nav-item to-index"><a href="/">Home</a></li>
    </ul>
</div>