@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Crear Perfil</h3>
                    </div>
                    <div class="card-body">
                        <form onsubmit="disable()" method="POST" enctype="multipart/form-data" action="{{route('perfil.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombres:</label>
                                        <input
                                        type="text"
                                        name="nombres"
                                        id="nombres"
                                        placeholder="Ingresa tus nombres"
                                        class="form-control mb-2"
                                        value="{{old('nombres')}}"
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
                                        value="{{old('apellidos')}}"
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
                                        value="{{old('edad')}}"
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
                                        value="{{old('direccion')}}"
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
                                        value="{{old('ntelefono')}}"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                  <input type="file" name="imgurl" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                  <label class="custom-file-label" for="inputGroupFile01">Elegir archivo</label>
                                </div>
                              </div>
                              <hr>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="button-prevent-multiple-submits" type="submit">
                                    <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                                    <span id="btex">Guardar</span></button>
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