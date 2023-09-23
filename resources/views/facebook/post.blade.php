<form action="{{route('post_coupon')}}" method="post" enctype="multipart/form-data">
    @csrf
    group id:<textarea name="id"  cols="30" rows="10"></textarea>
    url photo:<input type="text" name="photo">
    message:<textarea name="message"  cols="30" rows="10"></textarea>
    <input type="submit" value="post">
</form>
