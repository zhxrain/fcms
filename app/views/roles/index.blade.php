@extends('layouts.frame')

@section('content')
<div class='table'>
  <h3>角色列表</h3>
  <table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>角色名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
      <tr>
        <td>{{ $role->name }}</td>
        <td>{{ $role->description }}</td>
        <td>
          <table>
          <tr>
            <td>
              <a href='role/{{ $role->id }}'><img src="assets/edit.png"/></a>
            </td>
            <td>
              <a href="javascript:void(0)" onclick="deleteRole(this)"><img src="assets/delete.png"/></a>
            </td>
          </tr>
          </table>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  </br>
  <form action="/role/0" method="GET">
    <button type="submit" id="submit1" class="pure-button pure-button-primary"> 新建角色</button>
  </form>
</div>
<script>
  function deleteRole(){
    $.ajax({
      url: "role/{{ $role->id }}",
      type: 'DELETE',
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
