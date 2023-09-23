<form action="{{route('get_page_access_token')}}" method="post">
    @csrf
    Id:<input type="text" name="id" >
    Accesstoken:<input type="text" name="access_token" >
    <input type="submit" value="getAccess">
</form>
