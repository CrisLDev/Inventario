@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu dirección e-mail.') }}</div>

                <div class="card-body">
                    {{ __('Antes de continuar, por favor verifica tu email.') }}
                    {{ __('Si no reciviste un email de confirmación.') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click aquí para solicitar un nuevo email de confirmación.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
