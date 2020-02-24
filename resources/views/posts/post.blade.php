@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{$post->ps_nombre}}</span>
                    <a href="/posts/crear" class="btn btn-primary btn-sm">Nuevo Post</a>
                </div>

                <div class="card-body">
                    <img src="{{$post->ps_path}}" class="d-block w-100" style="height: 50vh !important;" alt="...">
                    <p>{{$post->ps_descripcion}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection