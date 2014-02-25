@extends('layouts.frame')

@section('content')
<div class="form">
  <form class="pure-form pure-form-aligned" action="/role" method="post">
    <fieldset>
        <legend><h3>新建角色</h3></legend>
        <div style="color: red;">
          {{ $msg_error or '' }}
        </div>
        <div class="pure-control-group">
            <label for="name">角色名:</label>
            <input id="name" name="rolename" type="text" placeholder="Rolename" value="{{ $rolename or ""}}" required>
        </div>

        <div class="pure-control-group">
            <label for="description">描述:</label>
            <input id="description" name="description" type="text" placeholder="Description" value="{{ $description or ""}}" required>
        </div>

        <div class="pure-controls">
            <button type="submit" id="submit1" class="pure-button pure-button-primary"> 提交</button>
        </div>

    </fieldset>
  </form>
</div>
@stop
