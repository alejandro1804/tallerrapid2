@extends('layouts.app')

@section('template_title')
    {{ $operator->name ?? "{{ __('Show') Operator" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Operator</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('operators.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $operator->name }}
                        </div>
                        <div class="form-group">
                            <strong>Position:</strong>
                            {{ $operator->position_id }}
                        </div>
                        <div class="form-group">
                            <strong>Phone:</strong>
                            {{ $operator->phone }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $operator->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
