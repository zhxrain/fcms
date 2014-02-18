@extends('layouts.frame')

@section('content')
  <h1>用户列表</h1>
  <table class="pure-table pure-table-bordered" style="margin-left: auto; margin-right: auto;">
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
              <a href='edit'><img src="assets/edit.png"/></a>
            </td>
            <td>
              <a href='delete'><img src="assets/delete.png"/></a>
            </td>
          </tr>
          </table>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@stop
