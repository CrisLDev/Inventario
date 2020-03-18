@extends('layouts.app')

@section('content')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
              <label for="" class="font-weight-bold">Nombre:</label>
            <label for="" id="nombre" class="cls"></label>
          </div>
          <div>
            <label for="" class="font-weight-bold">Descripcion:</label>
              <label for="" id="descripcion" class="cls"></label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Lista de Items</span>
                    <a href="/items/crear" class="btn btn-primary btn-sm">Nuevo Item</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha Creación</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <th scope="row"><div id="nid">{{$item->id}}</div></th>
                                    <td>{{$item->it_nombre}}</td>
                                    <td>{{$item->it_descripcion}}</td>
                                <td><a data-toggle="modal" data-target="#exampleModal" data-valor="{{$item->id}}" class="btn btn-primary btn-sm ajax">Ver Más</a>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$items->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
    $(".ajax").click(function(evt){
        $('.cls').empty();
        var $this = $(this);
        //$.get('getgi', function(data){
            //$('#getRequestData').append(data);
            //console.log(data);
        //});
        cnic = $this.data('valor');
        $.ajax({
            type: "GET",
            data: {'cnic':cnic},
            dataType: 'json',
            url: "getgi",
            success: function(data){
                $("#nombre").append(data.it_nombre);
                $("#descripcion").append(data.it_descripcion);
            }
        });
    });
});
    </script>
@endsection
