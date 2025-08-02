@extends('layouts.app')

@section('template_title')
    {{ $binnacle->name ?? "{{ __('Show') Binnacle" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Binnacle</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('binnacles.index',['id' => $binnacle->ticket_id]) }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ticket Id:</strong>
                            {{ $binnacle->ticket_id }}
                        </div>
                         
                        <div class="form-group">
                            <strong>Item:</strong>
                            {{ $binnacle->ticket->item->name }}
                        </div>
                        <div class="form-group">
                            <strong>Operator Id:</strong>
                            {{ $binnacle->user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Dia y hora:</strong>
                            {{ $binnacle->created_at }}
                        </div>
                        <div class="form-group">
                            <strong>Note:</strong>
                            {{ $binnacle->note }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
