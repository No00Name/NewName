@extends('layouts.layout')
@section('title')
 @parent - {{$title}}
@endsection
@section('content')
<table class="table table-striped">
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Имя пользователя</th>
      <th scope="col">Email</th>
      <th scope="col">Статус</th>
      <th scope="col">Изменить данные</th>
      <th scope="col">Изменить статус</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $user)
    <tr>
    <th scope="row">{{$user->id}}</th>
      <td>{{$user->Username}}</td>
      <td>{{$user->Email}}</td>
      @if($user->Banet == 1)
      <td style="color:red">{{$user->ban }}</td>
      @else
      <td>{{$user->ban }}</td>
      @endif
      <td><a href="{{ route('admin.create', ['id' => $user->id]) }}" class="btn btn-secondary my-2">Редактировать</a></td>  
@if($user->Role==0)
    <form method="POST" action="{{ route('admin.ban', ['id' => $user->id]) }}">
      @csrf
      @method('POST')
      @if($user->Banet == 1)
      <td> <button type="send" class="btn btn-success">Разбанить</button></td>
      @else
      <td> <button type="send" class="btn btn-danger">Забанить</button></td>
      @endif
    </form>
@else <td>Администратор</td>
@endif
    </tr>
    @endforeach
  </tbody>
</table>
</table>
@endsection