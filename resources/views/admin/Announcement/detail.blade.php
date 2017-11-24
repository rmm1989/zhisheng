<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>公告添加</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    {{--<link rel="shortcut icon" href="{{asset('backstage')}}/favicon.ico" type="image/x-icon" />--}}
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
        <form class="layui-form layui-form-pane">
            {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>公告标题
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="title" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="{{$info->title}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>发布人
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="author" required="" lay-verify="required"
                               autocomplete="off" class="layui-input" value="{{$info->author}}">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label"><span class="x-red">*</span>公告内容</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" class="layui-textarea" name="content">{{$info->content}}
                        </textarea>
                    </div>
                </div>
            </form>
    </div>

  </body>

</html>