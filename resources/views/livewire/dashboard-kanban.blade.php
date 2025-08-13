@extends('layouts.app')

@section('content') {{-- resources/views/livewire/dashboard-kanban.blade.php --}}
<div class="kanban-wrapper">
    <div class="py-4 px-3 bg-secondary bg-opacity-10">
        <div class="row gy-4">
            @foreach(['nuevo', 'ejecucion', 'espera'] as $estado)
                <div class="col-12 col-md-4">
                    <div class="bg-light p-4 rounded shadow-sm min-vh-25 kanban-column"
                         data-estado="{{ $estado }}"
                    >
                        <h5 class="fs-5 fw-bold mb-3 text-capitalize">
                            {{ strtoupper($estado) }}
                        </h5>

                        <div class="kanban-scroll" style="max-height: 400px; overflow-y: auto; padding-right: 8px;">
                            @foreach(${'tickets' . ucfirst($estado)} as $ticket)
                                @php
                                    $priorityStyle = match((int) $ticket->priority) {
                                        1 => 'background-color: #f8d7da; color: #721c24;',
                                        2 => 'background-color: #fff3cd; color: #856404;',
                                        3 => 'background-color: #d4edda; color: #155724;',
                                        4 => 'background-color: #e2e3e5; color: #383d41;',
                                        default => 'background-color: #ffffff; color: #212529;',
                                    };
                                @endphp

                                <div style="{{ $priorityStyle }} padding: 1rem; margin-bottom: 0.5rem;"
                                     class="ticket rounded shadow-sm cursor-move"
                                     draggable="true"
                                     data-ticket-id="{{ $ticket->id }}"
                                >
                                    <strong>{{ $ticket->item->name }}</strong> — {{ $ticket->flaw }}
                                    <p class="small mb-0">Prioridad: {{ $ticket->priority }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Botón de prueba -->
    <div class="text-center mt-4">
        <button onclick="Livewire.emit('ticketMovido', 42, 'EN EJECUCION')" class="btn btn-warning">
            Test: Mover ticket 42 a EN EJECUCION
        </button>
    </div>
</div>
@endsection

@section('scripts')
    @vite('resources/js/kanban.js')
@endsection

