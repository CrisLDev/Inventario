@extends('layouts.app')

@section('content')
<div class="container">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach ($posts as $post)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                  <a href="/posts/{{$post->ps_id}}">
                    <img src="{{$post->ps_path}}" class="d-block w-100" style="height: 50vh !important;" alt="...">
                  </a>
                    <div class="carousel-caption d-none d-md-block">
                      <h5>{{$post->ps_nombre}}</h5>
                  </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</div>
@endsection