<table class="table" id="tablaI">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha Creación</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
        </tr>
    </thead>
    <tbody id="tbody">
        @foreach ($items as $item)
            <tr class="item{{$item->id}}tr">
                <th scope="row"><div id="nid">{{$item->id}}</div></th>
                <td><label for="" class="item{{$item->id}}">{{$item->it_nombre}}</label></td>
                <td><label for="" class="item{{$item->id}}d">{{$item->it_descripcion}}</label></td>
            <td><a data-toggle="modal" data-target="#verModal" data-id="{{$item->id}}" class="btn btn-primary text-white btn-sm verMas">Ver Más</a>
            </tr>
        @endforeach
    </tbody>
</table>