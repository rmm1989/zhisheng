<html>
<script type="text/javascript" src="{{asset('homes')}}/style/js/jquery.js"></script>
<div>
    健康指导 助听指南
    <input type="button" id="aaa" value="查看更多">
    <input type="button" id="bbb" value="听力常识详情">
</div>
<script>
    $('#aaa').click(function(){
        $.ajax({
            'type' : 'get',
            'url' : 'more',
            'data' : {'offset':0,'limit':2},
            'dataType' : "text",
            success : function(msg){

            }
        })
    })
    $('#bbb').click(function(){
        $.ajax({
            'type' : 'get',
            'url' : 'detail',
            'data' : {'id':2},
            'dataType' : "text",
            success : function(msg){

            }
        })
    })
</script>
</html>