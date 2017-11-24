<html>
<h2>
    免费申领
</h2>
<form action="free_for" method="post">
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
            <th>申请佩戴位置:</th>
            <td>

                <select name="position" >
                    <option value="">--请选择佩戴位置</option>
                    <option value="1">左耳</option>
                    <option value="2">右耳</option>
                    <option value="3">双耳</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>申领理由:</th>
            <td>
                <input type="text" name="justification">
            </td>
        </tr>
        <tr>

            <th>个人基本情况</th>
            <td>
                <textarea name="base_case" id="" cols="30" rows="10"></textarea>
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

