@extends('layouts.frame')

@section('content')
<div class="form">
  <form class="pure-form pure-form-aligned" action="/user" method="post">
    <fieldset>
        <legend><h3>编辑账号</h3></legend>
        <div style="color: red;">
          {{ $msg_error or '' }}
        </div>
        <div class="pure-control-group">
            <label for="name">用户名:</label>
            <input id="name" name="username" type="text" placeholder="Username" value="{{ $username or ""}}" required>
        </div>

        <div class="pure-control-group">
            <label for="email">邮箱地址:</label>
            <input id="email" name="email" type="email" placeholder="Email Address" value="{{ $email or ""}}" required>
        </div>

        <div class="pure-control-group">
            <label for="password">密码:</label>
            <input id="password" name="password" type="password" placeholder="Password" required>
        </div>

        <div class="pure-control-group">
            <label for="password_again">再次输入密码:</label>
            <input id="password_again" name="password_again" type="password" placeholder="Password" required>
        </div>

        <div class="pure-control-group">
            <label for="role">所属角色:</label>
            <select id="role" name="rolename">
              @foreach($roles as $role)
                @if(isset($rolename))
                   @if ($role->name==$rolename)
                    <option selected="selected">{{ $role->name }}</option>
                   @else
                    <option>{{ $role->name }}</option>
                   @endif
                @else
                  <option>{{ $role->name }}</option>
                @endif
              @endforeach
            </select>
        </div>
        <div class="pure-controls">
            <button type="submit" id="submit1" class="pure-button pure-button-primary"> 提交</button>
        </div>

    </fieldset>
  </form>
</div>
@stop
