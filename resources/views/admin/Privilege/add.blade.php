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
    <div class="x-body">
        <form class="layui-form">
            {{csrf_field()}}
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>权限名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="priv_name" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>

          </div>
          <div class="layui-form-item">
              <label for="phone" class="layui-form-label">
                  <span class="x-red">*</span>父级权限
              </label>
              <div class="layui-input-inline">
                  <select name="parent_id" id="">
                      <option value="0"></option>
                      @foreach($privilege as $v)
                      <option value="{{$v->id}}">{{$v->priv_name}}</option>
                          @endforeach
                  </select>
              </div>

          </div>
            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">
                    <span class="x-red">*</span>权限级别
                </label>
                <div class="layui-input-inline">
                    <select name="garde" id="">
                        <option value="1"> 一级权限</option>
                        <option value="2"> 二级权限</option>

                    </select>
                </div>

            </div>
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>控制器名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" name="controller_name" autocomplete="off" class="layui-input">
              </div>

          </div>
          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>方法名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_pass" name="action_name" autocomplete="off" class="layui-input">
              </div>

          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
                  <span class="x-red">*</span>路由地址
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_repass" name="address" autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>

              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;
            //监听提交
            form.on('submit(add)', function(data){
                //发异步，把数据提交给php
                $.ajax({
                    type:'POST',
                    data:data.field,
                    url:"{{url('admin/privilege/add')}}",
                    dataType:'json',
                    success:function(data){
                        if(data.info == 1){
                            layer.alert("增加成功", {icon: 6},function () {
                                // 获得frame索引
                                var index = parent.layer.getFrameIndex(window.name);
                                //关闭当前frame
                                layer.closeAll('iframe');
                                parent.layer.close(index);
                            });
                        }
                    },
                })
            });
        });
    </script>
  </body>

</html>