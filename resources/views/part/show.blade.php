@extends('layouts.app')

@section('template_title')
    {{ $part->name ?? "{{ __('Show') Part" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Part</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('parts.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Item Id:</strong>
                            {{ $part->item->name }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $part->name }}
                        </div>
                        <div class="form-group">
                            <strong>Note:</strong>
                            {{ $part->note }}
                        </div>
                        <div class="form-group">
                            <strong>Provider Id:</strong>
                            {{ $part->provider->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
