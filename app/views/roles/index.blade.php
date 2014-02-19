@extends('layouts.frame')

@section('content')
<div class='table'>
  <h3>角色列表</h3>
  <table class="pure-table pure-table-bordered">
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
</div>
@stop
