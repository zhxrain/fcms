@extends('layouts.frame')

@section('content')
  <h1>角色列表</h1>
  <table class="pure-table pure-table-bordered" style="margin-left: auto; margin-right: auto;">
    <thead>
        <tr>
            <th>角色名称</th>
            <th>描述</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
      <tr>
        <td>{{ $role->name }}</td>
        <td>{{ $role->description }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@stop
