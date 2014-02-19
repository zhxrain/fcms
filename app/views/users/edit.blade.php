@extends('layouts.frame')

@section('content')
<div class="form">
  <form class="pure-form pure-form-aligned" action="{{ $user->id }}" method="post">
    <fieldset>
        <legend><h3>编辑账号</h3></legend>
        <div class="pure-control-group">
            <label for="name">用户名:</label>
            <input id="name" name="username" type="text" placeholder="Username" value="{{ $user->username or ""}}" required>
        </div>

        <div class="pure-control-group">
            <label for="email">邮箱地址:</label>
            <input id="email" name="email" type="email" placeholder="Email Address" value="{{ $user->email or ""}}">
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

    </fieldset>
  </form>
  <div class="pure-controls">
      <input type="button" onClick="putUser()" id="submit1" class="pure-button pure-button-primary" value="提交">
  </div>
</div>
<script>
  function putUser(){
    alert("button");
  }
</script>
@stop
