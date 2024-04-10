@extends('layouts.layout')

@section('title')
    @parent - {{$title}}
@endsection

@section('content')  
<div class="container">
    <h2 class="mb-3 mt-5">Регистрация пользователя</h2>
    <form class="mt-5" action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="mb-3 mt-5">
        @error('Username')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <label for="Username" class="form-label">Имя</label>
        <input type="text" name="Username" id="Username" class="form-control @error('Username') is-invalid @enderror" placeholder="Username"
        value="{{old('Username')}}">
    </div>

    <div class="mb-3 mt-5">
        @error('Email')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <label for="Email" class="form-label">Email</label>
        <input type="Email" name="Email" id="Email" class="form-control @error('Email') is-invalid @enderror" placeholder="Email"
        value="{{old('Email')}}">
    </div>

    <div class="mb-3 mt-5">
        @error('Password')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <label for="password" class="form-label">Пароль</label>
        <input type="password" name="password" id="password" class="form-control @error('Password') is-invalid @enderror" placeholder="Password">
    </div>

  
    <div class="mb-3 mt-5">
        <label for="UserPhoto" class="form-label">Фото</label>
        <input type="file" name="UserPhoto" id="UserPhoto" class="form-control-file">
    </div>

    <button type="sudmit" class="btn btn-primary">Отправить</button>
    </form>
</div>
@endsection