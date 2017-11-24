<html>
<h3>预约上门服务</h3>
<form action="{{url('service/re_service')}}" method="post">
    {{csrf_field()}}
    <table>
        <tr>
            <th>姓名:</th>
            <td>
                <input type="text" name="name">
            </td>
        </tr>
        <tr>
            <th>电话:</th>
            <td>
                <input type="text" name="phone">
            </td>
        </tr>
        <tr>
            <th>家庭地址:</th>
            <td>
                <input type="text" name="address">
            </td>
        </tr>
        <tr>
            <th>服务内容:</th>
            <td>
                <input type="text" name="service_content">
            </td>
        </tr>
        <tr>
            <th>预约上门时间:</th>
            <td>
                <input type="text" name="service_time">
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                <input type="hidden" name="openid" value="oB4nYjnoHhuWrPVi2pYLuPjnCaU0">
                <input type="submit" value="确认预约">
            </td>
        </tr>
    </table>
</form>
</html>