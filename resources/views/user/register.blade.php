<form action="{{route('user.register')}}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Enter Name">
    @error('name') {{$message}} @enderror
    <br><br>
    <input type="email" name="email" placeholder="Enter Email">
    @error('email') {{$message}} @enderror

    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    @error('password') {{$message}} @enderror

    <br><br>
    <input type="password" name="password_confirmation" placeholder="Reenter Password">
    @error('password') {{$message}} @enderror

    <br><br>
    <input type="submit" value="Register">
</form>

@if(\Session::has('success'))
<p>{{\Session::get('success')}}</p>
@endif
