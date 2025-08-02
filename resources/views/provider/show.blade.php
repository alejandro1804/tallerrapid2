@extends('layouts.app')

@section('template_title')
    {{ $provider->name ?? "{{ __('Show') Provider" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Provider</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('providers.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $provider->name }}
                        </div>
                        <div class="form-group">
                            <strong>Phone:</strong>
                            {{ $provider->phone }}
                        </div>
                        <div class="form-group">
                            <strong>Adress:</strong>
                            {{ $provider->adress }}
                        </div>
                        <div class="form-group">
                            <strong>Location:</strong>
                            {{ $provider->location }}
                        </div>
                        <div class="form-group">
                            <strong>Country:</strong>
                            {{ $provider->country }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
