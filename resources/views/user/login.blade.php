<form action="{{route('user.login')}}" method="POST">
    @csrf

    <input type="email" name="email" placeholder="Enter Email">
    @error('email') {{$message}} @enderror
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    @error('password') {{$message}} @enderror
    <br><br>

    <input type="submit" value="Login">
</form>
@if(\Session::has('error'))
<p>{{\Session::get('error')}}</p>
@endif
