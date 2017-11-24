<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>角色添加</title>
    <meta name="renderer" content="webkit">
    {{--<link rel="shortcut icon" href="{{asset('backstage')}}/favicon.ico" type="image/x-icon" />--}}
    <link rel="stylesheet" href="{{asset('backstage')}}/css/font.css">
    <link rel="stylesheet" href="{{asset('backstage')}}/css/xadmin.css">
      <link rel="stylesheet" href="{{asset('backstage')}}/lib/layui//css/layui.css" media="all">
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
        <form class="layui-form layui-form-pane" enctype="multipart/form-data" action="{{url('admin/instrument/add')}}" method="post">
            {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>仪器品牌
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="brands" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>序列号
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="serial_number" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>型号
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="model_number" required="" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>仪器图片
                </label>
                <div class="layui-input-inline">
                    <input type="file" name="picture" >
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>押金金额
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="security_deposit" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>日租金
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="day_rent" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>仪器功率
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="power" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>助听器线路
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="line" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="x-red">*</span>适配范围</label>
                <div class="layui-input-inline">
                    <select  name="adaptation_scope" class="select">
                        <option value="0">请选择适配范围</option>
                        <option value="1">0到6岁</option>
                        <option value="2">7到14岁</option>
                        <option value="3">14到50岁</option>
                        <option value="4">50岁以上</option>
                    </select>
                </div>

            </div>
                <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label">
                        </label>
                    <input type="submit" value="增加" class="layui-btn">

                    </div>
            </form>
    </div>

    <script>
        layui.use('upload', function(){
            var upload = layui.upload;
            //执行实例
            var uploadInst = upload.render({
                elem: '#test1' //绑定元素
                ,url: "{{url('admin/instrument/upload')}}" //上传接口
                ,data: {'_token':'{{csrf_token()}}'}
                ,done: function(res){
                    //上传完毕回调

                }
                ,error: function(){
                    //请求异常回调
                }
            });
        });
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
                    url:"{{url('admin/instrument/add')}}",
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