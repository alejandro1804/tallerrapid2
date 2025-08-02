@extends('layouts.app')

@section('template_title')
    {{ $item->name ?? "{{ __('Show') Item" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Item</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('items.index') }}"> {{ __('Back') }}</a>
                             <a class="btn btn-success" href="{{ route('items.qr', $item->id) }}" target="_blank">Imprimir QR</a>
                            </div>   
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $item->name }}
                        </div>
                        <div class="form-group">
                            <strong>Sector Id:</strong>
                            {{ $item->sector->name }}
                        </div>
                        <div class="form-group">
                            <strong>Characteristic:</strong>
                            {{ $item->characteristic }}
                        </div>
                        <div class="form-group">
                            <strong>Note:</strong>
                            {{ $item->note }}
                        </div>
                        <div class="form-group">
                            <strong>Trademark:</strong>
                            {{ $item->trademark }}
                        </div>
                        <div class="form-group">
                            <strong>Provider Id:</strong>
                            {{ $item->provider->name }}
                        </div>
                        <div class="form-group">
                            <strong>Imagen:</strong><br>
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Imagen del ítem" class="img-fluid rounded shadow-sm mt-2" style="max-width: 300px;">
                            @else
                                <span class="text-muted">No se ha subido imagen.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
