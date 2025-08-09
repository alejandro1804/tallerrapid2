@extends('layouts.app')

@section('content'){{-- resources/views/livewire/dashboard-kanban.blade.php --}}

    <div class="py-6 px-4">
        <h2 class="text-xl font-semibold mb-4">Tablero Kanban</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach(['nuevo', 'ejecucion', 'espera'] as $estado)
                <div class="bg-gray-100 p-4 rounded shadow min-h-[300px]"
                        ondrop="drop(event, '{{ $estado }}')" 
                         ondragover="allowDrop(event)"
                >
                    <h2 class="text-lg font-bold mb-2">
                        {{ strtoupper($estado) }}
                    </h2>

                    @foreach(${'tickets' . ucfirst($estado)} as $ticket)
                        <div 
                            class="bg-white p-3 mb-2 rounded shadow cursor-move"
                            draggable="true"
                            ondragstart="drag(event)"
                            id="ticket-{{ $ticket->id }}"
                        >
                            <strong>{{ $ticket->item->name }}</strong> — {{ $ticket->flaw }}
                            <p class="text-xs text-gray-500">Prioridad: {{ $ticket->priority }}</p>
                        </div>
                    @endforeach
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

