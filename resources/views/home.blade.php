@extends('layouts.app')

@section('content')

<main class="py-4">
  <div class="container">
    <h2 class="mb-4 text-center text-uppercase fw-semibold text-dark">GESTOR DE TALLER</h2>
        <div class="text-center mb-4">
            <img src="{{ asset('img/taller.jpg') }}" alt="Taller de reparación de maquinaria de panadería" class="img-fluid rounded">
        </div>
    </div>
</main>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
