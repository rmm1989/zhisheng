<html>
<form action="submit_address" method="post">
    {{csrf_field()}}
    <table>
        <tr>
            <th>收货人姓名:</th>
            <td>
                <input type="text" name="name">
            </td>
        </tr>
        <tr>
            <th>收货人电话:</th>
            <td>
                <input type="text" name="phone">
            </td>
        </tr>
        <tr>
            <th>收货地址:</th>
            <td>
                <input type="text" name="address">
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                <input type="submit" value="提交">
            </td>
        </tr>

    </table>
</form>
</html>