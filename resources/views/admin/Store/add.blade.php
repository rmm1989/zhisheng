<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>角色添加</title>
    <meta name="renderer" content="webkit">
    {{--<link rel="shortcut icon" href="{{asset('backstage')}}/favicon.ico" type="image/x-icon" />--}}
    <link rel="stylesheet" href="{{asset('backstage')}}/css/font.css">
    <link rel="stylesheet" href="{{asset('backstage')}}/css/xadmin.css">
      <script type="text/javascript" src="{{asset('backstage')}}/js/jquery.js"></script>
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
        <form class="layui-form layui-form-pane">
            {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>门店名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="store_name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>负责人
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="fzr_name" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>联系电话
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="phone" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>

            <div class="layui-form-item">
                <label class="layui-form-label"><span class="x-red">*</span>选择门店位置</label>
                <div class="layui-input-inline">
                    <select class="select" name="province" id="province" lay-filter="province">
                        <option value="">请选择省份</option>
                        @foreach($province as $v)
                            <option value="{{$v->code}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select id="city" name="city" class="select" lay-filter="city"></select>
                </div>
                <div class="layui-input-inline">
                    <select id="area" name="area" class="select" lay-filter="area"></select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="position" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
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
          form.on('select(province)',function(data){
              $('#city').html('');
              $('#area').html('');
              $.ajax({
                  type : 'get',
                  url : "{{url('admin/getCity')}}",
                  data : {'p_code':data.value},
                  dataType : "text",
                  success : function(msg){
                      $('#city').append(msg);
                      form.render('select')
                  }
              })
          })
            form.on('select(city)',function(data){
                $('#area').html('');
                $.ajax({
                    type : 'get',
                    url : "{{url('admin/getArea')}}",
                    data : {'c_code':data.value},
                    dataType : "text",
                    success : function(msg){
                        $('#area').append(msg);
                        form.render('select')
                    }
                })
            })
          //监听提交
          form.on('submit(add)', function(data){
            //发异步，把数据提交给php
              $.ajax({
                  type:'POST',
                  data:data.field,
                  url:"{{url('admin/store/add')}}",
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
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>