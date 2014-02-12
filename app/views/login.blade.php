@extends('layouts.login')

@section('content')
<div class="container">
  <section id="content">
    <form action="login" method="post">
      <h1>Login Form</h1>
      <div id="login-error">
        {{ $error or 'yield' }}
      </div>
      <div>
        <input type="text" name="username" placeholder="用户名" required="" id="username" />
      </div>
      <div>
        <input type="password" name="password" placeholder="口令" required="" id="password" />
      </div>
      <div id="rememberMe">
        <input type="checkbox" name="remember" value=1 />记住我?
      </div>
      <div>
        <input type="submit" value="登陆" />
        <!--a href="#">Lost your password?</a-->
      </div>
    </form><!--Log form -->
  </section><!-- content -->
</div><!-- container -->
@stop
