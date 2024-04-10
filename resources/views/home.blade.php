@extends('layouts.layout')

@section('title')
 @parent - {{$title}}
@endsection
  
@section('header')
@parent 
@endsection

@section('content')

<section class="py-5 text-center container " style = "background-image: url({{asset($image)}});
background-repeat: no-repeat;
  background-position: center center;
  background-attachment: fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">{{$title}}</h1>
        <p class="lead text-body-secondary">Тут тоже временно пусто как пойму что мы создаём возможно заполню</p> 
      </div>
    </div>
    <p>
          <a href="{{route('cat.one')}}" class="btn btn-secondary my-2">Категория 1</a>
          <a href="{{route('cat.two')}}" class="btn btn-secondary my-2">Категория 2</a>
          <a href="{{route('cat.three')}}" class="btn btn-secondary my-2">Категория 3</a>
          <a href="{{route('cat.four')}}" class="btn btn-secondary my-2">Категория 4</a>
          <a href="{{route('cat.five')}}" class="btn btn-secondary my-2">Категория 5</a>
        </p>
</section>


  <div class="album py-5 bg-body-tertiary">
    <div class="container">
    
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($posts as $post)
          <div class="col">
          <div class="card shadow-sm">
          @if ($post->AdPhoto!= null)
            <img src="{{  asset('storage/'.$post->AdPhoto)}}" alt="" width="100%" height="225">
          @else 
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
          @endif   
          
          
            <div class="card-body">
              <h5 class="card-title">{{$post->Title}}</h5>
              <p class="card-text">{{$post->Description}}</p>
              <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
              @if(Auth::check())
                @if(Auth::user()->Role == 1)
                  @if($post->Public == 0)
                  <form method="GET" action="{{ route('admin.press') }}">
                      @csrf
                      <input type="hidden" name="id" value="{{ $post->id }}">
                      <button type="submit" class="btn btn-sm btn-outline-success">Принять</button>
                  </form>
                  @else
                  <form method="GET" action="#">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-outline-secondary">Редактировать</button>
                  </form>
                  @endif
                  <form method="GET" action="#">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                  </form>
                @endif
              @endif
              </div>
              <figcaption class="blockquote-footer ">
                {{$post->users->Username}} 
              </figcaption>
              
                
              </div>
            </div>
          </div>
          </div>
          @endforeach 
            <div class="col-md-12">
              {{$posts->links('vendor.pagination.simple-bootstrap-4')}}
            </div>
            <div class="col-md-12">
              {{$posts->appends(['test'=>request()->test])->links('vendor.pagination.bootstrap-4')}}
            </div>
        
        
        
      </div>
      
    </div>
  </div>

@endsection
