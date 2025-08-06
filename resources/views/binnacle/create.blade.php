@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Binnacle
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Binnacle</span>
                    </div>
                    <div class="alert alert-info mb-3">
    <strong>Ticket #:</strong> {{ $ticket->id }}  
    <br>
    <strong>Ítem asociado:</strong> {{ $ticket->item->name ?? 'Sin nombre' }}  
    <br>
    <strong>Descripción del ítem:</strong> {{ $ticket->item->description ?? 'Sin descripción' }}
</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('binnacles.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('binnacle.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
