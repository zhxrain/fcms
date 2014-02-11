<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="en" />

  <?= javascript_include_tag() ?>
  <?= stylesheet_link_tag() ?>

<title>Login</title>
</head>
<body>
<div class="container">
  <section id="content">
    <form action="login" method="post">
      <h1>Login Form</h1>
      <div id="login-error">
        {{ $error or '' }}
      </div>
      <div>
        <input type="text" name="username" placeholder="用户名" required="" id="username" />
      </div>
      <div>
        <input type="password" name="password" placeholder="口令" required="" id="password" />
      </div>
      <div id="rememberMe">
        <input type="checkbox" name="rememberMe" value=1 />记住我?
      </div>
      <div>
        <input type="submit" value="登陆" />
        <!--a href="#">Lost your password?</a-->
      </div>
    </form><!--Log form -->
  </section><!-- content -->
</div><!-- container -->
</body>
</html>
