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
        <button class="layui-btn" onclick="x_admin_show('添加用户','{{url('admin/instrument/add')}}')"><i class="layui-icon"></i>添加</button>
        <button class="layui-btn" onclick="send_msg()"><i class="layui-icon"></i>发送消息</button>

        <span class="x-right" style="line-height:40px">共有数据：{{$data->total()}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>序列号</th>
            <th>品牌</th>
            <th>型号</th>
            <th>图片</th>
            <th>线路</th>
            <th>功率</th>
            <th>适配范围</th>
            <th>押金金额</th>
            <th>日租金</th>
            <th>操作</th>
          </tr>
        </thead>
       <tbody>
        @foreach($data as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->serial_number}}</td>
            <td>{{$v->brands}}</td>
            <td>{{$v->model_number}}</td>
            <td>
              <img src="{{URL::asset($v->picture)}}" alt="">
            </td>
            <td>{{$v->line}}</td>
            <td>{{$v->power}}</td>
            <td>
              {{$v->adaptation_scope}}
            </td>
            <td>{{$v->security_deposit}}</td>
            <td>{{$v->day_rent}}</td>
            <td class="td-manage">
              <a title="编辑"  onclick="x_admin_show('编辑','{{url("admin/instrument/edit/$v->id")}}')" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="删除" onclick="instrument_del(this,'{{$v->id}}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{$data->render()}}
        </div>
      </div>

    </div>
    <script>
      function send_msg(){
          layer.confirm('确认发送？',function(index){
              $.ajax({
                  type:'get',
                  url:"{{url('admin/send_message')}}",
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
      /*仪器-删除*/
      function instrument_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              $.ajax({
                  type:'GET',
                  url:"{{url('admin/instrument/del')}}/"+id,
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
    </script>
  </body>

</html>