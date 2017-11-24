<html>

<form action="{{url('listen/listening_test')}}" method="post">
    {{ csrf_field() }}
    选择自己的年龄段：
    <select name="agerange">
        <option value="1">0-6岁</option>
        <option value="2">7-14岁</option>
        <option value="3">15-50岁</option>
        <option value="4">50以上</option>
    </select>
    <input type="hidden" name="offset" value="0">
    <input type="hidden" name="length" value="3">
    <input type="hidden" name="question_cate" value="1">

    <input type="submit" value="确认选择">
</form>

</html>