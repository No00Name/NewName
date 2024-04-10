@extends('layouts.layout')

@section('title')
    @parent - {{$title}}
@endsection

@section('content')  
<div class="container" style="max-width: 600px;">
    <form class="mt-5" action="{{route('post.store')}}" method="POST"  enctype="multipart/form-data">
        @csrf
    <div class="mb-3 mt-5">
        <label for="AdPhoto" class="form-label">Изображениен</label>
        <input type="file" name="AdPhoto" id="picturs" class="form-control-file">
    </div>
    <div class="mb-3 mt-5">
        @error('Title')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <label for="Title" class="form-label">Название</label>
        <input type="text" name="Title" id="Title" class="form-control @error('Title') is-invalid @enderror" placeholder="Title"
        value="{{old('Title')}}">
    </div>
    <div class="mb-3">
        @error('Description')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <label for="Description" class="form-label">Содержимое</label>
        <textarea name="Description" name ="Description" id="Description" class="form-control  @error('Description') is-invalid @enderror"  rows="5">{{old('Description')}}</textarea>
    </div>
    @error('Category_id')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
    <select name="Category_id" id="Category_id" class="form-select mb-3  @error('Category_id') is-invalid @enderror">
        <option selected>Выберите рубрику</option>
        @foreach ($category as $key => $value)
        <option value="{{$key}}"
        @if(old('Category_id')==$key) selected @endif
        >{{$value}}</option>
        @endforeach
    </select>
    <button type="sudmit" class="btn btn-primary">Отправить</button>
    </form>
</div>
@endsection