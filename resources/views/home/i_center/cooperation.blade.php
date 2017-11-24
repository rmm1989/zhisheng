<html>
<h2>
    商业合作
</h2>
<form action="cooperation" method="post">
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
            <th>公司名称:</th>
            <td>
                <input type="text" name="company_name">
            </td>
        </tr>
        <tr>
            <th>公司地址:</th>
            <td>
                <input type="text" name="company_address">
            </td>
        </tr>
        <tr>

            <th>合作内容:</th>
            <td>
                <textarea name="description" id="" cols="30" rows="10"></textarea>
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

