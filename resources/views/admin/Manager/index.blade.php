<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="{{asset('backstage')}}/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('backstage')}}/css/font.css">
    <link rel="stylesheet" href="{{asset('backstage')}}/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('backstage')}}/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('backstage')}}/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
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
        <form class="layui-form layui-col-md12 x-so">
          <input class="layui-input" placeholder="开始日" name="start" id="start">
          <input class="layui-input" placeholder="截止日" name="end" id="end">
          <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','{{url("admin/manager/add")}}')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$managers->total()}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>登录名</th>
            <th>手机</th>
            <th>邮箱</th>
            <th>角色名称</th>
            <th>加入时间</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($managers as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->id}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->phone}}</td>
            <td>{{$v->email}}</td>
            <td>{{$v->role['role_name']}}</td>
            <td>{{date('Y-m-d H:i:s',$v->time)}}</td>
            <td class="td-status">
              @if($v->status == 1)
              <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
              @else
              <span class="layui-btn-disabled">已停用</span>
            @endif
            </td>
            <td class="td-manage">
             @if($v->status == 1)
                <a onclick="manager_stop(this,'{{$v->id}}')" href="javascript:;"  title="禁用">
                  <i class="layui-icon">&#xe62f;</i>
                </a>
            @else
                <a onclick="manager_start(this,'{{$v->id}}')" href="javascript:;"  title="启用">
                  <i class="layui-icon">&#xe601;</i>
                </a>
            @endif

              <a title="编辑"  onclick="x_admin_show('编辑','{{url("admin/manager/edit/$v->id")}}')" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="删除" onclick="manager_del(this,'{{$v->id}}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{$managers->render()}}
        </div>
      </div>
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
    /*用户-启用*/
      function manager_start(obj,id){
          layer.confirm('确认要启用吗？',function(index){
                  $.ajax({
                      type:'GET',
                      url:"{{url('admin/manager/start')}}/"+id,
                      dataType:'json',
                      success:function(data){
                          if(data.info == 1){
                              $(obj).attr('title','停用')
                              $(obj).find('i').html('&#xe62f;');
                              $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>');
                              layer.msg('已启用!',{icon: 6,time:1000});
                          }
                      }
                  })
          });
      }
      /*用户-停用*/
      function manager_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){
              $.ajax({
                  type:'GET',
                  url:"{{url('admin/manager/stop')}}/"+id,
                  dataType:'json',
                  success:function(data){
                      if(data.info == 1){
                          $(obj).attr('title','启用')
                          $(obj).find('i').html('&#xe601;');
                          $(obj).parents("tr").find(".td-status").html('<span class="layui-btn-disabled">已停用</span>');
                          layer.msg('已停用!',{icon: 5,time:1000});
                      }
                  }
              })

          });
      }



      /*管理员-删除*/
      function manager_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              $.ajax({
                  type:'GET',
                  url:"{{url('admin/manager/del')}}/"+id,
                  dataType:'json',
                  success:function(data){
                      if(data.info == 1){
                          $(obj).parents("tr").remove();
                          layer.msg('已删除!',{icon:1,time:1000});
                      }else{
                          layer.msg('删除失败!',{icon:4,time:1000});
                      }
                  }
              })

          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
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