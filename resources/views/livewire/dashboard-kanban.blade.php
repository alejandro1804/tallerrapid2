@extends('layouts.app')

@section('content'){{-- resources/views/livewire/dashboard-kanban.blade.php --}}

<!--div class="py-4 px-3"-->
<div class="py-4 px-3 bg-secondary bg-opacity-10">
    <div class="row gy-4">
        @foreach(['nuevo', 'ejecucion', 'espera'] as $estado)
            <div class="col-12 col-md-4">
                <div class="bg-light p-4 rounded shadow-sm min-vh-25"
                     ondrop="drop(event, '{{ $estado }}')"
                     ondragover="allowDrop(event)"
                >
                    <h5 class="fs-5 fw-bold mb-3 text-capitalize">
                        {{ strtoupper($estado) }}
                    </h5>

                    {{-- Contenedor con scroll --}}
                    <div class="kanban-scroll" style="max-height: 400px; overflow-y: auto; padding-right: 8px;">
                        @foreach(${'tickets' . ucfirst($estado)} as $ticket)
                           @php
                                $priorityStyle = match((int) $ticket->priority) {
                                    1 => 'background-color: #f8d7da; color: #721c24;', // alta
                                    2 => 'background-color: #fff3cd; color: #856404;', // media
                                    3 => 'background-color: #d4edda; color: #155724;', // baja
                                    4 => 'background-color: #e2e3e5; color: #383d41;', // crítica
                                    default => 'background-color: #ffffff; color: #212529;', // default
                                };
                            @endphp

                            <div style="{{ $priorityStyle }} padding: 1rem; margin-bottom: 0.5rem;"
                                class="rounded shadow-sm cursor-move"
                                draggable="true"
                                ondragstart="drag(event)"
                                id="ticket-{{ $ticket->id }}"
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

<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev, nuevoEstado) {
        ev.preventDefault();
        const ticketId = ev.dataTransfer.getData("text").split('-')[1];
        Livewire.emit('ticketMovido', ticketId, nuevoEstado);
    }
</script>
@endsection
