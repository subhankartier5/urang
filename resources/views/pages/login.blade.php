@extends('pages.layouts.master')
@section('content')
<div class="login-signup">
  <div class="main-content">
  <div class="container">
    <div class="row login">
      <h2>Login</h2>
      <div class="col-md-2"></div>
      <div class="col-md-8">
        @if(Session::has('fail'))
          <div class="alert alert-danger">{{Session::get('fail')}}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          </div>
        @else
        @endif
        @if(Session::has('success'))
          <div class="alert alert-success">                               {{Session::get('success')}}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          </div>
        @else
        @endif
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <p class="forgot-password"><a href="#">Forgotten Password?</a></p>
        <p class="signup-link">Don't Have an account ?<a href="{{route('getSignUp')}}"> Sign Up</a></p>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</div>
</div>
@endsection