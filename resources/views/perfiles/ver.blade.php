@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-xl-4 col-md-12">
                        @if ($perfil)
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img class="img-thumbnail imgperfil" src="{{$perfil->imgurl}}" alt="imagendeperfil">
                                </div>
                            </div>
                        @else
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img class="img-thumbnail imgperfil" src="imgs/no-image.jpg" alt="imagendeperfil">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-8 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div>
                                    <h5><div class="circle-left"></div> Información de inicio de sesión</h5>
                                    <div>
                                        <label class="font-weight-bold">Usuario:</label> <label> {{ Auth::user()->name }}</label>
                                    </div>
                                    <div>
                                        <label class="font-weight-bold">E-mail:</label> <label> {{ Auth::user()->email }}</label>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        @if ($perfil)
                            <div>
                                <h5>Información personal</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <label class="font-weight-bold">Nombres:</label> <label> {{ $perfil->nombres }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="font-weight-bold">Apellidos:</label> <label> {{ $perfil->apellidos }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="font-weight-bold">Edad:</label> <label> {{ $perfil->edad }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="font-weight-bold">Dirección:</label> <label> {{ $perfil->direccion }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="font-weight-bold">N#_Teléfono:</label> <label> {{ $perfil->ntelefono }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <a class="btn btn-warning btn-sm" href="{{route('perfil.edit', Auth::user()->id)}}">Editar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center">
                                ¡No tienes un perfil, crea uno ahora! <a href="{{route('perfil.create')}}">Click Aquí</a>
                            </div>
                        @endif
                    </div>
                </div>
                @if (count($roles) > 0)
                <div class="card">
                    <div class="card-body">
                        <h5>Roles y permisos</h5>
                        <label class="font-weight-bold">Rol:</label> <label>{{$roles[0]->name}}</label>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection