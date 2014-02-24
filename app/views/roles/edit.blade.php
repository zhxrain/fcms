@extends('layouts.frame')

@section('content')
<div class="form">
  <form class="pure-form pure-form-aligned" action="/role" method="post">
    <fieldset>
        <legend><h3>编辑角色</h3></legend>
        <div style="color: red;">
          {{ $msg_error or '' }}
        </div>
        <div class="pure-control-group">
            <label for="name">角色名:</label>
            <input id="name" name="rolename" type="text" placeholder="Rolename" value="{{ $role->name or ""}}" readonly>
        </div>

        <div class="pure-control-group">
            <label for="description">描述:</label>
            <input id="description" name="description" type="text" placeholder="Description" value="{{ $role->description or ""}}" required>
        </div>

        <div class="pure-controls">
            <input type="button" onClick="putRole()" id="submit1" class="pure-button pure-button-primary" value="提交">
        </div>

    </fieldset>
  </form>
</div>
<script>
  function putRole(){
    $.ajax({
        url: "{{ $role->id }}",
        type: 'PUT',
        data: {
          rolename: $("#name").val(),
          description: $("#description").val(),
        },
        success: function(data){
          document.location.href='/role';
        },
        error: function(jqxhr) {
          alert(jqxhr.responseText); // @text = response error, it is will be errors: 324, 500, 404 or anythings else
        }
    });
  }
</script>
@stop
