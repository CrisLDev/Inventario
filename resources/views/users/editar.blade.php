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
                        <form id="form-prevent-multiple-submits" method="POST" action="{{route('users.update', $user->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de Usuario</label>
                                        <input
                                        type="text"
                                        name="name"
                                        id="nombre"
                                        placeholder="Nombre"
                                        class="form-control mb-2"
                                        value="{{$user->name}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Email de Usuario</label>
                                        <input
                                        type="text"
                                        name="email"
                                        id="email"
                                        placeholder="Email"
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
                                            <label>Contraseña:</label>
                                            <input
                                            type="password"
                                            name="password_confirmation"
                                            id="password"
                                            placeholder="Ingresa tus contraseña"
                                            class="form-control mb-2"
                                            />
                                        </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <ul class="list-unstyled">
                                    @foreach ($roles as $role)
                                    @if ('isadmin')
                                    <label>
                                        <input type="checkbox" value="{{$role->id}}" name="roles[]" @if($role->users->contains($user->id)) checked=checked @endif>
                                        <label>{{$role->name}}</label>
                                        <em>({{$role->description ?: 'N/A'}})</em>
                                    </label><br>
                                    @else
                                    @if ($loop->first)
                                        @can('isadmin')
                                        <label>
                                            <input type="checkbox" value="{{$role->id}}" name="roles[]" @if($role->users->contains($user->id)) checked=checked @endif>
                                            <label>{{$role->name}}</label>
                                            <em>({{$role->description ?: 'N/A'}})</em>
                                        </label><br>
                                        @endcan
                                        @else
                                        <input type="checkbox" value="{{$role->id}}" name="roles[]" @if($role->users->contains($user->id)) checked=checked @endif>
                                        <label>{{$role->name}}</label>
                                        <em>({{$role->description ?: 'N/A'}})</em>
                                    </label><br>
                                        @endif
                                        
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button class="btn btn-warning btn-block" id="crear-prevent-multiple-submits" type="submit">
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