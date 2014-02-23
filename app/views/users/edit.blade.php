@extends('layouts.frame')

@section('content')
<div class="form">
  <form class="pure-form pure-form-aligned" action="{{ $user->id }}" method="post">
    <fieldset>
        <legend><h3>编辑账号</h3></legend>
        <div class="pure-control-group">
            <label for="name">用户名:</label>
            <input id="name" name="username" type="text" placeholder="Username" value="{{ $user->username or ""}}" readonly>
        </div>

        <div class="pure-control-group">
            <label for="email">邮箱地址:</label>
            <input id="email" name="email" type="email" placeholder="Email Address" value="{{ $user->email or ""}}" required>
        </div>

        <div class="pure-control-group">
            <label for="role">所属角色:</label>
            <select id="role" name="rolename">
              @foreach($roles as $role)
                @if($role->name==$user->roles->first()['name'])
                  <option selected="selected">{{ $role->name }}</option>
                @else
                  <option>{{ $role->name }}</option>
                @endif
              @endforeach
            </select>
        </div>
        <div class="pure-controls">
            <input type="button" onClick="putUser()" id="submit1" class="pure-button pure-button-primary" value="提交">
        </div>

    </fieldset>
  </form>
  <form class="pure-form">
      <fieldset>
          <input type="hidden" id="token" name="token" value="{{{ Session::getToken() }}}">
          <legend><h3>修改密码</h3></legend>

          <label for="old-password">旧密码:</label>
          <input id="old-password" type="password" name="old_password" placeholder="旧密码">
          <label for="new-password">新密码:</label>
          <input id="new-password" type="password" name="new_password" placeholder="新密码">
          <label for="new-password-again">再输一次新密码:</label>
          <input id="new-password-again" type="password" name="new_password_again" placeholder="新密码">

          <input type="button" onClick="putPassword()" id="submit1" class="pure-button pure-button-primary" value="修改">
      </fieldset>
  </form>
</div>
<script>
  function putUser(){
    $.ajax({
        url: "{{ $user->id }}",
        type: 'PUT',
        data: {
          name: $("#name").val(),
          rolename: $("#role").val(),
          email: $("#email").val(),
        },
        success: function(data){
          document.location.href='/user';
        },
        error: function(jqxhr) {
          alert(jqxhr.responseText); // @text = response error, it is will be errors: 324, 500, 404 or anythings else
        }
    });
  }

  function putPassword(){
    $.ajax({
        url: "{{ $user->id }}",
        type: 'PUT',
        data: {
          old_password: $("#old-password").val(),
          new_password: $("#new-password").val(),
          new_password_again: $("#new-password-again").val(),
          token: $("#token").val(),
        },
        success: function(data){
          document.location.href='/user';
        },
        error: function(jqxhr) {
          alert(jqxhr.responseText); // @text = response error, it is will be errors: 324, 500, 404 or anythings else
        }
    });
  }
</script>
@stop
