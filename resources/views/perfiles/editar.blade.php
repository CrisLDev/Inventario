@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Editar Usuario
                    </div>
                    <div class="card-body">
                        <form onsubmit="disable()" method="POST" enctype="multipart/form-data" action="{{route('perfil.update', $user->id)}}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Usuario:</label>
                                        <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        placeholder="Ingresa tus usuario"
                                        class="form-control mb-2"
                                        value="{{$user->name}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input
                                        type="text"
                                        name="email"
                                        id="email"
                                        placeholder="Ingresa tu email"
                                        class="form-control mb-2"
                                        value="{{$user->email}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contraseña:</label>
                                        <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        placeholder="Ingresa tus contraseña"
                                        class="form-control mb-2"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirmar contraseña:</label>
                                        <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password"
                                        placeholder="Ingresa tus contraseña"
                                        class="form-control mb-2"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombres:</label>
                                        <input
                                        type="text"
                                        name="nombres"
                                        id="nombres"
                                        placeholder="Ingresa tus nombres"
                                        class="form-control mb-2"
                                        value="{{$perfil->nombres}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apellidos:</label>
                                        <input
                                        type="text"
                                        name="apellidos"
                                        id="apellidos"
                                        placeholder="Ingresa tus apellidos"
                                        class="form-control mb-2"
                                        value="{{$perfil->apellidos}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Edad:</label>
                                        <input
                                        type="number"
                                        name="edad"
                                        id="edad"
                                        placeholder="Ingresa tu edad."
                                        class="form-control mb-2"
                                        value="{{$perfil->edad}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dirección:</label>
                                        <input
                                        type="text"
                                        name="direccion"
                                        id="direccion"
                                        placeholder="Ingresa tu direccion."
                                        class="form-control mb-2"
                                        value="{{$perfil->direccion}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Número de teléfono:</label>
                                        <input
                                        type="number"
                                        name="ntelefono"
                                        id="ntelefono"
                                        placeholder="Ingresa tu número de teléfono."
                                        class="form-control mb-2"
                                        value="{{$perfil->ntelefono}}"
                                        />
                                    </div>
                                </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                      <input type="file" name="imgurl" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label" for="inputGroupFile01">Elegir foto</label>
                                    </div>
                                  </div>
                                  <label class="font-weight-bold">El tamaño de la imagen no debe ser mayor a 1 MB.</label>
                            </div>
                            </div>
                              <div class="alert alert-danger pt-1 pb-1" role="alert">
                                <label class="mb-0"><input type="checkbox" name="antigua" id="antigua"><em>(Utilizar foto anterior.)</em></label>
                              </div>
                              <hr>
                            <div class="form-group">
                                <button class="btn btn-warning btn-block" id="button-prevent-multiple-submits" type="submit">
                                    <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                                    <span id="btex">Editar</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#inputGroupFile01').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
    });
</script>
@endsection