<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>Role List</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/font.css">
    @include('admin.public.style')
    @include('admin.public.script')
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="layui-anim layui-anim-up">
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
{{--        <form class="layui-form layui-col-md12 x-so" method="get" action="{{url('admin/user')}}">--}}
{{--            <div class="layui-input-inline">--}}
{{--                <select name="num" lay-filter="aihao">--}}
{{--                    <option value="3" @if($request->input('num') == 3) selected @endif>3</option>--}}
{{--                    <option value="5" @if($request->input('num') == 5) selected @endif>5</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--          <input type="text" name="username" value="{{$request->input('username')}}" placeholder="input username" autocomplete="off" class="layui-input">--}}
{{--            <input type="text" name="email" value="{{$request->input('email')}}" placeholder="input email" autocomplete="off" class="layui-input">--}}
{{--          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>--}}
{{--        </form>--}}
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>Batch Remove</button>
        <button class="layui-btn" onclick="x_admin_show('Add User','{{url('admin/user/create')}}',600,400)"><i class="layui-icon"></i>Add</button>
        <span class="x-right" style="line-height:40px"></span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>Role Name</th>
            <th>Operation</th></tr>
        </thead>
        <tbody>
        @foreach($role as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->id}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->id}}</td>
            <td>{{$v->role_name}}</td>
{{--            <td class="td-status">--}}
{{--              <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>--}}
            <td class="td-manage">
                <a title="Grant" href="{{url('admin/role/auth/'.$v->id)}}">
                    <i class="layui-icon">&#xe612;</i>
                </a>
              <a title="Edit"  onclick="x_admin_show('Edit','{{url('admin/user/'.$v->id.'/edit')}}',600,400)" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
                <input type="hidden" name="_token" value="dTLnwzObzzQI3gWvCL8UDvkvb9mwDP8YKdNUfVMz">
              <a title="删除" onclick="member_del(this,{{$v->id}})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
{{--      <div class="page">--}}
{{--          {{$user->appends($request->all())->render()}}--}}
{{--      </div>--}}

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }

          });
      }

      /* delete user*/
      function member_del(obj,id){
          var _token = $('input[name="_token"]').val();
          layer.confirm('Delete？',function(){
              $.ajax({
                  url:'user/'+id,
                  type:'DELETE',
                  headers:{'X-CSRF-TOKEN':_token},
                  data:{
                      uid:id,
                  },
                  success:function (res) {
                      if(res.status == 0){
                          $(obj).parents("tr").remove();
                          layer.msg(res.message,{icon:6,time:1000});
                      }else{
                          layer.msg(res.message,{icon:5,time:1000});
                      }
                  },
                  error:function (err) {
                      console.log(err);
                  }
              });
          });
      }
      /* batch delete*/
      function delAll () {
          var _token = $('input[name="_token"]').val();
        //get all ids that need to delete
          var ids = [];
          $(".layui-form-checked").not('.header').each(function (i,v) {
              var u = $(v).attr('data-id');
              ids.push(u);
          })
        layer.confirm('Delete？',function(){
            // console.log('11111');
            $.ajax({
                url:'user/del',
                type:'POST',
                headers:{'X-CSRF-TOKEN':_token},
                data:{
                    uid:ids,
                },
                success:function (res) {
                    console.log(res.status);
                    if(res.status === 0){
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                        layer.msg(res.message,{icon:6,time:1000});
                    }else{
                        layer.msg(res.message,{icon:5,time:1000});
                    }
                },
                error:function (err) {
                    console.log(err);
                }
            });
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>
