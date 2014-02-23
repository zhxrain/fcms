@extends('layouts.frame')

@section('content')
<div class='table'>
  <h3>用户列表</h3>
  <table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>用户名</th>
            <th>Email</th>
            <th>所属角色</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->roles->first()['name'] }}</td>
        <td>
          <table>
          <tr>
            <td>
              <a href='user/{{ $user->id }}'><img src="assets/edit.png"/></a>
            </td>
            <td>
              <a href="javascript:void(0)" onclick="deleteUser(this)"><img src="assets/delete.png"/></a>
            </td>
          </tr>
          </table>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  </br>
  <form action="/user/0" method="GET">
    <button type="submit" id="submit1" class="pure-button pure-button-primary"> 新建用户</button>
  </form>
</div>
<script>
  function deleteUser(){
    $.ajax({
        url: "user/{{ $user->id }}",
        type: 'DELETE',
    }).then(function(data) {
        if(data == '200')
          document.location.href='/user';
    });
  }
</script>
@stop
