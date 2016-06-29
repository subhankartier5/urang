@extends('pages.layouts.master-black')
@section('content')
       <div class="login-page">
        @if(Session::has('fail'))
          <div class="alert alert-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> {{Session::get('fail')}}
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
          <div class="form">
            <!--<form class="register-form" role="form" method="post" action="register.php">
              <input type="text" placeholder="name"/>
              <input type="password" placeholder="password"/>
              <input type="text" placeholder="email address"/>
              <button>create</button>
              <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>-->
            <form class="login-form" role="form" action="{{route('postCustomerLogin')}}" method="post">
               <input type="email"  id="exampleInputEmail1" name="email" placeholder="Email" required="">
               <input type="password"  id="exampleInputPassword1" name="password" placeholder="Password" required="">
               <div style="float: left;">
                 <input name="remember" type="checkbox" value="1" style="display: inline-block; width: auto; margin: 0; position: relative; top: 2px;">
                 <p style="display: inline;"> Remember Me</p>
               </div>
              <button type="submit">Login</button>
              <input type="hidden" name="_token" value="{{Session::token()}}"></input>
              <p class="message">Not registered? <a href="{{route('getSignUp')}}">Create an account</a></p>
            </form>
          </div>
        </div>
      </div>

         <!-- Scripts -->
        
            <script language="javascipt" type="text/javascript">
                function check(form)
                {
                     form.message.value='';
                     if(form.username.value == "")
                     {
                        form.message.value='Please enter your username';
                        form.username.focus();
                        return false;
                     }
                     else if(form.password.value == "")
                     {
                        form.message.value='Please enter your password';
                        form.password.focus();
                        return false;
                     }
                     else
                     {
                        return true;
                     }
                }
                </script>
        
         <!-- /Scripts -->
@endsection

