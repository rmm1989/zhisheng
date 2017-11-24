<html>
<script type="text/javascript" src="{{asset('homes')}}/style/js/jquery.js"></script>

<form action="listening_test" method="post">
    {{ csrf_field() }}
    <table>
        <tr>
            <th>姓名：</th>
            <td>
                <input type="text" name="name">
            </td>
        </tr>
        <tr>
            <th>手机号：</th>
            <td>
                <input type="text" name="phone">
            </td>
        </tr>
        <tr>
            <th>预约时间：</th>
            <td>
                <input type="text" name="reservation_time">
            </td>
        </tr>
        <tr>
            <th>选择门店：</th>
            <td>
                省:<select name="province" id="province">
                    <option value="#">请选择省份</option>
                    @foreach($province as $v)
                        <option value="{{$v->code}}">{{$v->name}}</option>
                        @endforeach
                </select>

                市:<select name="city" id="city">
                    <option value="#">请选择市</option>
                </select>

                县:<select name="area" id="area">
                    <option value="#">请选择县</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <select name="store_num" id="aaa">

                </select>
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                <input type="submit" value="确认预约">
            </td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    $('#province').change(function(){
        var p_code = $(this).val();
        $.ajax({
            'type' : 'get',
            'url' : 'getCity',
            'data' : {'p_code':p_code},
            'dataType' : "text",
            success : function(msg){
                $('#city').empty();
                $('#area').empty();
                $('#city').append(msg);
            }
        })
    })

    $('#city').change(function(){
        var c_code = $(this).val();
        $.ajax({
            'type' : 'get',
            'url' : 'getArea',
            'data' : {'c_code':c_code},
            'dataType' : "text",
            success : function(msg){
                $('#area').empty();
                $('#area').append(msg);
            }
        })
    })

    $('#area').change(function(){
        var a_code = $(this).val();
        $.ajax({
            'type' : 'get',
            'url' : 'getStore',
            'data' : {'a_code':a_code},
            'dataType' : "text",
            success : function(msg){
                $('#aaa').append(msg);
            }
        })
    })
</script>
</html>