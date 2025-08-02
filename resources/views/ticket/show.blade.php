@extends('layouts.app')

@section('template_title')
    {{ $ticket->name ?? "{{ __('Show') Ticket" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Ticket</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tickets.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>Ticket id</strong>
                            {{ $ticket->id }}
                        </div>
                        
                        <div class="form-group">
                            <strong>State:</strong>
                            {{ $ticket->State->name }}
                        </div>
                        <div class="form-group">
                            <strong>Admission:</strong>
                            {{ $ticket->admission }}
                        </div>
                        <div class="form-group">
                            <strong>Item Id:</strong>
                            {{ $ticket->item->name }}
                        </div>
                        <div class="form-group">
                            <strong>Flaw:</strong>
                            {{ $ticket->flaw }}
                        </div>
                        <div class="form-group">
                            <strong>Priority:</strong>
                            {{ $ticket->priority }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
