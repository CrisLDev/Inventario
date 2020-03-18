@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="card-title mb-0">
                        {{ $item->it_nombre }}
                    </h2>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="noombre">
                            Nombre: 
                        </div>
                        <div class="nombre">
                            {{ $item->it_nombre }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection